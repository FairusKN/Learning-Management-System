<?php

namespace App\Http\Controllers;

use App\Http\Controllers\student\StudentTaskController;
use App\Http\Controllers\teacher\TeacherTaskController;
use Auth;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    //Shared Route Controller

    public function dashboardCaller(Request $request)
    {
        $user = Auth::user();

        return match(true) {
            $user->hasRole('student') => StudentTaskController::indexStudent($request),
            $user->hasRole('teacher') => TeacherTaskController::indexTeacher($request),
            default => abort(403),
        };
    }

    public function assignmentCaller(Request $request)
    {
        $user = Auth::user();

        return match(true) {
            $user->hasRole('student') => StudentTaskController::showTaskStudent($request),
            $user->hasRole('teacher') => TeacherTaskController::showTaskTeacher($request),
            default => abort(403),
        };
    }
}
