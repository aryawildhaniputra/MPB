<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materi;
use App\Models\Users;
use App\Models\MateriDocument;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Services\PdfConversionService;
use Illuminate\Support\Facades\Log;

class MateriController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $materis = Materi::when($search, function($query) use ($search) {
            // Clean up and normalize search term
            $search = trim($search);

            // Split search by spaces or slashes to handle partial terms
            $searchTerms = preg_split('/[\s\/]+/', $search, -1, PREG_SPLIT_NO_EMPTY);

            return $query->where(function($q) use ($searchTerms) {
                foreach ($searchTerms as $term) {
                    if (strlen($term) >= 2) { // Only search for terms with at least 2 characters
                        // Use the LOWER function for case-insensitive comparison
                        $q->orWhereRaw('LOWER(title) LIKE ?', ['%' . strtolower($term) . '%']);
                    }
                }
            });
        })->get();

        return view('materi.index', compact('materis', 'search'));
    }

    public function create()
    {
        return view('materi.add');
    }

    public function store(Request $request)
    {
        // Create the materi
        $materi = Materi::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content
        ]);

        // Handle document uploads
        if ($request->hasFile('documents')) {
            $documents = $request->file('documents');
            $titles = $request->document_titles;

            foreach ($documents as $index => $document) {
                if ($document->isValid()) {
                    $documentTitle = isset($titles[$index]) && !empty($titles[$index]) ? $titles[$index] : null;

                    // Get file details
                    $originalName = $document->getClientOriginalName();
                    $extension = $document->getClientOriginalExtension();
                    $mimeType = $document->getMimeType();
                    $size = $document->getSize();

                    // Validate that this is a PDF
                    if (strtolower($extension) !== 'pdf' || $mimeType !== 'application/pdf') {
                        continue; // Skip non-PDF files
                    }

                    // Create slug from materi title
                    $materiSlug = Str::slug($materi->title);

                    // Create a unique filename using materi title
                    $fileName = $materiSlug . '-' . time() . '-' . $index . '.pdf';

                    // Store the file
                    $path = $document->storeAs('uploads/documents', $fileName, 'public');

                    // Create document record
                    MateriDocument::create([
                        'materi_id' => $materi->id,
                        'title' => $documentTitle ?? $originalName,
                        'file_path' => $path,
                        'file_name' => $fileName,
                        'mime_type' => 'application/pdf',
                        'document_type' => 'pdf',
                        'size' => $size
                    ]);
                }
            }
        }

        return redirect()->route('materi.index')->with('success', 'Materi berhasil ditambahkan!');
    }

    public function show(Materi $materi)
    {
        // Track that the user has viewed this materi
        if (Auth::check()) {
            // Get the authenticated user from Users model
            $user = Users::find(Auth::id());
            if ($user) {
                // Just track access, let frontend update progress
                $user->trackMateriProgress($materi->id);
            }
        }

        // Get user progress if authenticated
        $userProgress = 0;
        if (Auth::check()) {
            $userProgress = $materi->getProgressForUser(Auth::id());
        }

        // Load documents
        $documents = $materi->documents;

        return view('materi.show', compact('materi', 'userProgress', 'documents'));
    }

    public function edit(Materi $materi)
    {
        // Load documents for the edit view
        $documents = $materi->documents;
        return view('materi.edit', compact('materi', 'documents'));
    }

    public function update(Request $request, Materi $materi)
    {
        // Update basic materi information
        $materi->update([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content
        ]);

        // Handle document uploads
        if ($request->hasFile('documents')) {
            $documents = $request->file('documents');
            $titles = $request->document_titles;

            foreach ($documents as $index => $document) {
                if ($document->isValid()) {
                    $documentTitle = isset($titles[$index]) && !empty($titles[$index]) ? $titles[$index] : null;

                    // Get file details
                    $originalName = $document->getClientOriginalName();
                    $extension = $document->getClientOriginalExtension();
                    $mimeType = $document->getMimeType();
                    $size = $document->getSize();

                    // Validate that this is a PDF
                    if (strtolower($extension) !== 'pdf' || $mimeType !== 'application/pdf') {
                        continue; // Skip non-PDF files
                    }

                    // Create slug from materi title
                    $materiSlug = Str::slug($materi->title);

                    // Create a unique filename using materi title
                    $fileName = $materiSlug . '-' . time() . '-' . $index . '.pdf';

                    // Store the file
                    $path = $document->storeAs('uploads/documents', $fileName, 'public');

                    // Create document record
                    MateriDocument::create([
                        'materi_id' => $materi->id,
                        'title' => $documentTitle ?? $originalName,
                        'file_path' => $path,
                        'file_name' => $fileName,
                        'mime_type' => 'application/pdf',
                        'document_type' => 'pdf',
                        'size' => $size
                    ]);
                }
            }
        }

        // Add flash message for success
        return redirect()->route('materi.index')->with('success', 'Materi berhasil diperbarui!');
    }

    public function destroy(Materi $materi)
    {
        // Delete associated documents
        foreach ($materi->documents as $document) {
            // Delete the file from storage
            if (Storage::exists($document->file_path)) {
                Storage::delete($document->file_path);
            }

            // Delete the record
            $document->delete();
        }

        // Delete the materi
        $materi->delete();

        // Add flash message for success
        return redirect()->route('materi.index')->with('success', 'Materi berhasil dihapus!');
    }

    /**
     * Update the progress for a materi.
     */
    public function updateProgress(Request $request, Materi $materi)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        $request->validate([
            'progress' => 'required|integer|min:0|max:100',
        ]);

        // Get the authenticated user from Users model
        $user = Users::find(Auth::id());
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Check if the materi is already completed and points awarded
        $userMateri = $materi->users()
            ->where('user_id', $user->id)
            ->first();

        // If points are already awarded, just return success with no points
        if ($userMateri && $userMateri->pivot->points_awarded > 0) {
            return response()->json([
                'progress' => $userMateri->pivot->progress,
                'completed' => true,
                'last_accessed_at' => $userMateri->pivot->last_accessed_at,
                'points_awarded' => 0,
                'message' => 'Materi already completed'
            ]);
        }

        $completed = $request->progress >= 100;
        $progress = $user->trackMateriProgress($materi->id, $request->progress, $completed);

        // Award 10 points to the user when they complete a material
        $pointsAwarded = 0;
        if ($completed && $progress->completed) {
            // Check current user progress in database (refresh data after the update)
            $userMateri = $materi->users()
                ->where('user_id', $user->id)
                ->first();

            // Only award points if this is a new completion (not previously completed)
            // or if the user hasn't been awarded points yet
            if ($userMateri && (!$userMateri->pivot->points_awarded || $userMateri->pivot->points_awarded == 0)) {
                // Update user's total points
                $user->total_points = ($user->total_points ?? 0) + 10;
                $user->save();

                // Mark material as having awarded points
                $materi->users()->updateExistingPivot($user->id, ['points_awarded' => 10]);

                $pointsAwarded = 10;

                // Log points awarded for debugging
                Log::info("Points awarded for materi completion: {$pointsAwarded} to user {$user->id} for materi {$materi->id}");
            } else {
                // Log that no points were awarded
                Log::info("No points awarded for materi {$materi->id} for user {$user->id}. Points already awarded: " .
                    ($userMateri && $userMateri->pivot->points_awarded ? 'Yes' : 'No'));
            }
        }

        return response()->json([
            'progress' => $progress->progress,
            'completed' => $progress->completed,
            'last_accessed_at' => $progress->last_accessed_at,
            'points_awarded' => $pointsAwarded
        ]);
    }

    /**
     * Delete a document from a materi.
     */
    public function deleteDocument($id)
    {
        $document = MateriDocument::findOrFail($id);

        // Check if the file exists and delete it
        if (Storage::exists($document->file_path)) {
            Storage::delete($document->file_path);
        }

        // Delete the record
        $document->delete();

        return response()->json(['success' => true]);
    }
}
