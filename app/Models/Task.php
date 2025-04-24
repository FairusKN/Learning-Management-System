<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug','description', 'teacher_id','resource_path'];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function classes()
    {
        return $this->belongsToMany(Classroom::class, 'class_task', 'task_id', 'class_id');
    }

    public function submissions()
    {
        return $this->hasMany(TaskSubmission::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';  // Make sure it's set to 'slug'
    }
}
