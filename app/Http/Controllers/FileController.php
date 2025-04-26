<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;

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

        $escapedInput = escapeshellarg($inputTempPath);
        $escapedOutputDir = escapeshellarg($outputFolderPath);

        $cmd = "libreoffice --headless --convert-to pdf $escapedInput --outdir $escapedOutputDir";

        exec($cmd, $output, $return_var);

        if ($return_var !== 0) {
            throw new \Exception('LibreOffice conversion failed.');
        }
    }
}
