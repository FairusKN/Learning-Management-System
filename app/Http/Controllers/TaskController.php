<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Auth;
use App\Models\Task;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TaskSubmission;

class TaskController extends Controller
{
    //Route Controller

    public function dashboardCaller(Request $request)
    {
        $user = Auth::user();

        return match(true) {
            $user->hasRole('student') => $this->indexStudent($request),
            $user->hasRole('teacher') => $this->indexTeacher($request),
            default => abort(403),
        };
    }

    public function assignmentCaller(Request $request)
    {
        $user = Auth::user();

        return match(true) {
            $user->hasRole('student') => $this->showTaskStudent($request),
            $user->hasRole('teacher') => $this->showTaskTeacher($request),
            default => abort(403),
        };
    }

    

    //Student Stuff

    public function indexStudent(Request $request)
    {
        $user = Auth::user();
        $classroom = $user->classes()->first();
        $submittedTaskIds = $user->submissions()->pluck('task_id');
        
        if ($classroom) {
            $tasks = $classroom->tasks()
                ->whereNotIn('tasks.id', $submittedTaskIds)
                ->orderBy('created_at', 'desc')
                ->limit(3)
                ->get();
        } else {
            $tasks = collect();
        }

        $tasks_history = TaskSubmission::where('student_id', Auth::id())->limit(3)->get();
        return view('students.dashboard', compact('tasks', 'tasks_history'));
    }

    public function taskSubmission(Request $request, $task_slug)
    {
        $task = Task::where('slug', $task_slug)->first();
        return view('students.submit_task', compact('task'));
    }

    public function taskSubmissionUpload(Request $request, $task)
    {
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
            "task_id" => $task->id,
            "student_id" => Auth::id(),
            "file_path" => $filepath,
            "grade" => 0,
        ]);

        return redirect('/dashboard')->with("success", "File Uploaded.");
    }

    public function showTaskStudent(Request $request)
    {
        $user = Auth::user();
        $classroom = $user->classes()->first();
        
        if ($classroom) {
            $tasks = $classroom->tasks()
                ->orderBy('created_at', 'desc')
                ->get();
        }

        $tasks_history = TaskSubmission::where('student_id', Auth::id())->latest()->get();
        return view('students.assignment', compact('tasks', 'tasks_history'));
    }


    //Teacher Stuff

    public function indexTeacher(Request $request)
    {
        $user = Auth::user();
        $tasks = $user->tasks()->with('classes')->limit(5)->get();
        
        return view('teachers.dashboard', compact('tasks'));
    }

    public function showTaskTeacher(Request $request)
    {
        $tasks = Task::where('teacher_id', Auth::id())->latest()->get();
        return view("teachers.task", compact("tasks"));
    }
}
