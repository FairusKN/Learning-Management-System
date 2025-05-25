<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class PDFController extends Controller
{
    public function showGradeReceipt()
    {
        $user = Auth::user();
        $classroom = $user->classes()->first();
        $grades = $user->submissions()->with('task')->get();

        return view('students.grade_report_view', compact('user', 'classroom', 'grades'))
            ->with(['student' => $user]); // for clarity
    }

    public function downloadGradeReceiptPdf()
    {
        $student = Auth::user();
        $classroom = $student->classes()->first();
        $grades = $student->submissions()->with('task')->get();

        $pdf = Pdf::loadView('students.grade_report_download', compact('student', 'classroom', 'grades'))
                ->setPaper('A4', 'portrait');

        return $pdf->stream('grade-report.pdf'); 
    }
}
