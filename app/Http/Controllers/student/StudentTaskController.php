<?php

namespace App\Http\Controllers\student;

use Auth;
use App\Models\Task;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TaskSubmission;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FileController;

class StudentTaskController extends Controller
{
    public static function indexStudent(Request $request)
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

    public static function showTaskStudent(Request $request)
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

    public function taskSubmission(Request $request, $task_slug)
    {
        $task = Task::where('slug', $task_slug)->first();

        // check wether student has upload a file, if yes abort 403, if not proceed

        if (!TaskSubmission::where('student_id', Auth::id())->where('task_id', $task->id)->exists()) {
            return view('students.submit_task', compact('task'));
        }

        abort(403, 'You already submitted this task');
    }

    public function taskSubmissionUpload(Request $request, $task_id)
    {
        $task = Task::where('id', $task_id)->firstOrFail();

        $teacherFolder = Str::slug($task->teacher->name);
        $taskFolder = Str::slug($task->title);
        $studentFolder = Str::slug(Auth::user()->name);
        $originalName = $request->file('file')->getClientOriginalName();
        $timestamp = now()->format('Ymd_His');
        $filename = $timestamp . '_' . $originalName;

        $request->validate([
            "file" => "required|file|mimes:png,jpg,jpeg,pdf,doc,docx,xls,xlsx,ppt,pptx,odt,ods,odp|max:10240"
        ]);

        $file_extension = $request->file('file')->extension();
        $can_convert_from = ['doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'odt', 'ods', 'odp'];

        $storageFolder = "submission/teacher_{$teacherFolder}/task_{$taskFolder}/student_{$studentFolder}";
        $storagePath = storage_path('app/' . $storageFolder);

        if (!file_exists($storagePath)) {
            mkdir($storagePath, 0755, true);
        }

        if (in_array($file_extension, $can_convert_from)) {
            // Save temp file
            $tempPath = $request->file('file')->getRealPath();

            // Convert and get new file path
            $convertedFileName = pathinfo($filename, PATHINFO_FILENAME) . '.pdf';
            FileController::officeToPDF($tempPath, $storagePath);

            $filepath = $storageFolder . '/' . $convertedFileName;
        } else {
            // Directly store the file without converting
            $filepath = $request->file('file')->storeAs($storageFolder, $filename);
        }

        TaskSubmission::create([
            "task_id" => $task->id,
            "student_id" => Auth::id(),
            "file_path" => $filepath,
            "grade" => 0,
        ]);

        return redirect('/dashboard')->with("success", "File Uploaded.");
    }

}
