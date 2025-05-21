<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Exception;
use Illuminate\Support\Facades\File;

class PdfConversionService
{
    /**
     * Convert a PowerPoint file to PDF
     *
     * @param string $inputPath Full path to the PowerPoint file
     * @param string $outputPath Full path where the PDF should be saved
     * @return bool True if conversion was successful
     */
    public function convertPowerPointToPdf($inputPath, $outputPath)
    {
        try {
            // Check if LibreOffice is installed and available
            if ($this->isLibreOfficeAvailable()) {
                return $this->convertUsingLibreOffice($inputPath, $outputPath);
            }

            // If LibreOffice is not available, try GhostScript if available
            if ($this->isGhostScriptAvailable()) {
                return $this->convertUsingGhostScript($inputPath, $outputPath);
            }

            // If all automatic conversion methods fail, create a simple PDF wrapper
            // that just includes a message and link to download the original file
            return $this->createPdfWrapper($inputPath, $outputPath);
        } catch (Exception $e) {
            Log::error('PDF conversion failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Convert using LibreOffice
     */
    private function convertUsingLibreOffice($inputPath, $outputPath)
    {
        // Get the directory of the output path
        $outputDir = dirname($outputPath);

        // Prepare the command for LibreOffice to convert the file
        $command = 'libreoffice --headless --convert-to pdf --outdir ' .
                  escapeshellarg($outputDir) . ' ' .
                  escapeshellarg($inputPath);

        // Execute the command
        $output = null;
        $returnVar = null;
        exec($command, $output, $returnVar);

        // Check if the command was successful
        if ($returnVar !== 0) {
            Log::error('LibreOffice conversion failed: ' . implode("\n", $output));
            return false;
        }

        // LibreOffice outputs the file with the original name but .pdf extension
        // We need to rename it to match our expected output path
        $baseName = pathinfo($inputPath, PATHINFO_FILENAME);
        $libreOfficeOutput = $outputDir . '/' . $baseName . '.pdf';

        if (file_exists($libreOfficeOutput) && $libreOfficeOutput !== $outputPath) {
            rename($libreOfficeOutput, $outputPath);
        }

        return file_exists($outputPath);
    }

    /**
     * Convert using GhostScript if available
     */
    private function convertUsingGhostScript($inputPath, $outputPath)
    {
        // This is a placeholder as GhostScript can't directly convert PPTX to PDF
        // but it could be used in a chain with other tools
        return false;
    }

    /**
     * Create a simple PDF wrapper when conversion isn't possible
     * This uses TCPDF to create a simple PDF with a message and download link
     */
    private function createPdfWrapper($inputPath, $outputPath)
    {
        try {
            if (!class_exists('TCPDF')) {
                Log::warning('TCPDF not available for fallback PDF creation');
                return false;
            }

            // Get file information
            $fileName = basename($inputPath);
            $fileSize = File::size($inputPath);
            $formattedSize = $this->formatFileSize($fileSize);

            // Create new PDF document
            $pdf = new \TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

            // Set document information
            $pdf->SetCreator('Media Pembelajaran');
            $pdf->SetAuthor('Media Pembelajaran System');
            $pdf->SetTitle('PowerPoint Document: ' . $fileName);
            $pdf->SetSubject('PowerPoint Viewer');

            // Remove header/footer
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);

            // Add a page
            $pdf->AddPage();

            // Set font
            $pdf->SetFont('helvetica', '', 12);

            // Add content
            $html = '
            <h1 style="color:#3366CC;font-size:20pt;">PowerPoint Document</h1>
            <p style="font-size:12pt;"><strong>Nama File:</strong> ' . $fileName . '</p>
            <p style="font-size:12pt;"><strong>Ukuran:</strong> ' . $formattedSize . '</p>
            <p style="font-size:12pt;margin-top:30px;">File ini adalah presentasi PowerPoint yang tidak dapat ditampilkan langsung. Silakan unduh file aslinya untuk melihat presentasi.</p>
            <p style="font-size:12pt;margin-top:10px;">Jika Anda memiliki LibreOffice atau Microsoft PowerPoint terpasang di komputer Anda, file akan terbuka otomatis setelah diunduh.</p>
            <p style="font-size:12pt;color:#CC0000;margin-top:30px;">Catatan: Untuk alasan keamanan, selalu periksa file yang Anda unduh sebelum membukanya.</p>
            ';

            $pdf->writeHTML($html, true, false, true, false, '');

            // Close and output PDF document
            $pdf->Output($outputPath, 'F');

            return file_exists($outputPath);
        } catch (Exception $e) {
            Log::error('Failed to create PDF wrapper: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Format file size for display
     */
    private function formatFileSize($bytes)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= (1 << (10 * $pow));

        return round($bytes, 2) . ' ' . $units[$pow];
    }

    /**
     * Check if LibreOffice is available
     */
    private function isLibreOfficeAvailable()
    {
        exec('libreoffice --version 2>&1', $output, $returnVar);
        return $returnVar === 0;
    }

    /**
     * Check if GhostScript is available
     */
    private function isGhostScriptAvailable()
    {
        exec('gs --version 2>&1', $output, $returnVar);
        return $returnVar === 0;
    }
}
