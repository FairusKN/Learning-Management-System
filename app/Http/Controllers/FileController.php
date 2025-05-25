<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;
use Illuminate\Support\Facades\Log;

class FileController extends Controller
{
    public static function officeToPDF($inputTempPath, $outputFolderPath)
    {
        if (!file_exists($inputTempPath)) {
            abort(400, 'Invalid uploaded file.');
        }

        if (!file_exists($outputFolderPath)) {
            mkdir($outputFolderPath, 0755, true);
        }

        // Move to persistent tmp folder
        $persistentTempDir = storage_path('app/tmp');
        if (!file_exists($persistentTempDir)) {
            mkdir($persistentTempDir, 0755, true);
        }

        $filename = pathinfo($inputTempPath, PATHINFO_BASENAME);
        $persistentTempPath = $persistentTempDir . '/' . $filename;
        copy($inputTempPath, $persistentTempPath);

        $escapedInput = escapeshellarg($persistentTempPath);
        $escapedOutputDir = escapeshellarg($outputFolderPath);

        // ✅ Corrected syntax
        $cmd = "libreoffice --headless --convert-to pdf:writer_pdf_Export $escapedInput --outdir $escapedOutputDir";

        exec($cmd . ' 2>&1', $output, $return_var);

        if ($return_var !== 0) {
            Log::error("LibreOffice conversion failed", [
                'command' => $cmd,
                'output' => $output,
                'return_var' => $return_var,
            ]);
            throw new \Exception('LibreOffice conversion failed. Check logs.');
        }
    }

}
