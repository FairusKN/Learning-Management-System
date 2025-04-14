<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Task;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TaskSubmission;

class TaskController extends Controller
{
    public function indexStudent(Request $request)
    {
        $tasks = Task::orderBy('created_at', 'desc')->limit(3)->get();
        $tasks_history = TaskSubmission::where('student_id', Auth::id())->limit(3)->get();
        return view('dashboard', compact('tasks', 'tasks_history'));
    }

    public function taskSubmission(Request $request, $id)
    {
        $task = Task::find($id);
        return view('students.submit_task', compact('task'));
    }

    public function taskSubmissionUpload(Request $request, $task_id)
    {
        $task = Task::findOrFail($task_id);

        $teacherFolder = Str::slug($task->teacher->name);
        $taskFolder = Str::slug($task->title);
        $studentFolder = Str::slug(Auth::user()->name);

        $request->validate([
            "file" => "required|file|mimes:png,jpg,jpeg,pdf,docx,xlsx,pptx|max:10240"
        ]);

        $originalName = $request->file('file')->getClientOriginalName();
        $timestamp = now()->format('Ymd_His');
        $filename = $timestamp . '_' . $originalName;

        $filepath = $request->file('file')->storeAs(
            "submission/teacher_{$teacherFolder}/task_{$taskFolder}/student_{$studentFolder}",
            $filename
        );

        TaskSubmission::create([
            "task_id" => $task_id,
            "student_id" => Auth::id(),
            "file_path" => $filepath,
            "grade" => 0,
        ]);

        return redirect('/dashboard')->with("success", "File Uploaded.");
    }

}
