<?php

namespace App\Http\Controllers\teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\TaskSubmission;
use Auth;

class GradingController extends Controller
{
    public function grading(Request $request, Task $task)
    {
        $submissions = $task->submissions()->with('student.classes')->get();
        // dd($submissions);

        return view('teachers.student_to_grade', compact('task', 'submissions'));
    }

    public function grade(Task $task, TaskSubmission $submission)
    {
        $submission->load('student.classes');
    
        return view('teachers.grade', compact('submission'));
    }

    public function submit_grade(Request $request, TaskSubmission $submission)
    {
        

        $request->validate([
            "grade" => 'required|numeric|min:1|max:100'
        ]);

        $grade = $request->input('grade');
        
        $submission->grade = $grade;

        $submission->save();

        return redirect('/dashboard')->with("success", "Task has been graded.");

    }

}