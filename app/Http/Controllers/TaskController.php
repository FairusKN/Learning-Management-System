<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskSubmission;
use Auth;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function showTask(Request $request)
    {
        $tasks = Task::orderBy('created_at', 'desc')->limit(3)->get();
        $tasks_history = TaskSubmission::where('student_id', Auth::id())->limit(3)->get();
        return view('dashboard', compact('tasks', 'tasks_history'));
    }
}
