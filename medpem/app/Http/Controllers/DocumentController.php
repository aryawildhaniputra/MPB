<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\MateriDocument;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DocumentController extends Controller
{
    /**
     * Upload dokumen (PDF, DOCX, PPT, PPTX) untuk TinyMCE
     */
    public function upload(Request $request)
    {
        // Validasi request
        $request->validate([
            'file' => 'required|file|max:10240|mimes:pdf,doc,docx,ppt,pptx',
        ]);

        if ($request->hasFile('file')) {
            try {
                $file = $request->file('file');

                // Ensure the file is valid
                if (!$file->isValid()) {
                    return response()->json(['error' => 'File yang diupload tidak valid'], 400);
                }

                $originalName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $mimeType = $file->getMimeType();
                $fileSize = $file->getSize();

                // Maximum file size (10MB)
                $maxFileSize = 10 * 1024 * 1024;
                if ($fileSize > $maxFileSize) {
                    return response()->json(['error' => 'Ukuran file terlalu besar (maksimal 10MB)'], 400);
                }

                // Buat nama file yang unik
                $fileName = Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '-' . time() . '.' . $extension;

                // Simpan file ke direktori yang sesuai
                $path = $file->storeAs('uploads/documents', $fileName, 'public');

                // Tentukan jenis dokumen berdasarkan ekstensi
                $docType = $this->getDocumentType($extension);

                // Buat URL untuk akses publik
                $url = asset('storage/' . $path);

                // Kirim respons ke TinyMCE
                return response()->json([
                    'location' => $url,
                    'name' => $originalName,
                    'docType' => $docType,
                    'mime' => $mimeType,
                    'success' => true
                ]);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
            }
        }

        return response()->json(['error' => 'File tidak ditemukan'], 400);
    }

    /**
     * Download dokumen
     */
    public function download($fileName)
    {
        $path = 'uploads/documents/' . $fileName;

        if (Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->download($path);
        }

        abort(404, 'File tidak ditemukan');
    }

    /**
     * Serve document with proper mime type
     */
    public function serve(Request $request, $id)
    {
        // Find the document
        $document = MateriDocument::findOrFail($id);

        // Get the file path
        $path = $document->file_path;

        // Check if file exists
        if (!Storage::disk('public')->exists($path)) {
            abort(404, 'File tidak ditemukan');
        }

        // Define MIME types for different document types
        $mimeTypes = [
            'pdf' => 'application/pdf',
            'doc' => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'ppt' => 'application/vnd.ms-powerpoint',
            'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
        ];

        // Set the correct MIME type
        $mimeType = $document->mime_type;
        if (isset($mimeTypes[$document->document_type])) {
            $mimeType = $mimeTypes[$document->document_type];
        }

        // Check if download is requested
        $forceDownload = $request->has('download');

        // Stream the file with the correct MIME type
        $response = new StreamedResponse(function() use ($path) {
            $stream = Storage::disk('public')->readStream($path);
            fpassthru($stream);
            if (is_resource($stream)) {
                fclose($stream);
            }
        });

        $response->headers->set('Content-Type', $mimeType);

        // Set appropriate Content-Disposition header
        if ($forceDownload) {
            $response->headers->set('Content-Disposition', 'attachment; filename="' . $document->file_name . '"');
        } else {
            $response->headers->set('Content-Disposition', 'inline; filename="' . $document->file_name . '"');
        }

        // Set cache and CORS headers
        $response->headers->set('Cache-Control', 'no-cache, no-store, must-revalidate');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', '0');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'GET, OPTIONS');
        $response->headers->set('Access-Control-Allow-Headers', 'Origin, Content-Type, Accept');

        return $response;
    }

    /**
     * Menentukan jenis dokumen berdasarkan ekstensi
     */
    private function getDocumentType($extension)
    {
        switch (strtolower($extension)) {
            case 'pdf':
                return 'pdf';
            case 'doc':
            case 'docx':
                return 'word';
            case 'ppt':
            case 'pptx':
                return 'powerpoint';
            default:
                return 'document';
        }
    }
}
