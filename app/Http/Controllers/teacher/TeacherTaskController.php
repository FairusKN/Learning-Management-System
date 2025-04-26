<?php

namespace App\Http\Controllers\teacher;

use Auth;
use App\Models\Task;
use App\Models\Classroom;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeacherTaskController extends Controller
{
    public static function indexTeacher(Request $request)
    {
        $user = Auth::user();
        $tasks = $user->tasks()->with('classes')->limit(5)->get();
        
        return view('teachers.dashboard', compact('tasks'));
    }

    public static function showTaskTeacher(Request $request)
    {
        $tasks = Task::where('teacher_id', Auth::id())->latest()->get();
        return view("teachers.task", compact("tasks"));
    }

    public function showCreateTask(Request $request)
    {
        $classes = Classroom::all();
        return view("teachers.create_task", compact('classes'));
    }

    public function createTask(Request $request)
    {
        $user = Auth::user();
        $filepath = null;

        $teacherFolder = Str::slug($user->name);
        $request->validate([
            'title' => "bail|required|max:255",
            'description' => "required",
            "file" => "bail|file|mimes:png,jpg,jpeg,pdf,docx,xlsx,pptx|max:20240",
            "states" => 'bail|required|array',
            "states.*" => 'string',
        ]);

        dd($request->file('file')->extension());

        // Rename File to date_filename
        if ($request->file('file')) {
            $originalfileName = $request->file('file')->getClientOriginalName();
            $timestamp = now()->format('Ymd_His'); 
            $filename = $timestamp . '_' . $originalfileName;  
            $filepath = $request->file('file')->storeAs(
                "resources/teacher_{$teacherFolder}/", $filename
            );
        }
        

        // Get all form data
        $title = $request->input('title');
        $slug = Str::slug($title);
        $description = $request->input('description');
        $classes = $request->input('states');

        $task = Task::create([
            "title" => $title,
            "slug" => $slug,
            "description" => $description,
            "teacher_id" => $user->id,
            "resource_path" => $filepath ? $filepath : null,
        ]);

        $task->classes()->attach($classes);

        return redirect('/dashboard')->with("success", "File Uploaded.");
    }
}
