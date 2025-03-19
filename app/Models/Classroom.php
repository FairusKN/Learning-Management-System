<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function students()
    {
        return $this->belongsToMany(User::class, 'class_student', 'class_id', 'user_id')
                    ->where('role', 'student');
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'class_task', 'class_id', 'task_id');
    }
}
