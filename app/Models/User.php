<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laratrust\Contracts\LaratrustUser;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\HasRolesAndPermissions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements LaratrustUser
{
    use HasFactory, Notifiable, HasRolesAndPermissions;

    protected $fillable = ['name', 'username', 'password'];
    protected $hidden = ['password'];
    

    public function classes()
    {
        return $this->belongsToMany(Classroom::class, 'class_student', 'user_id', 'class_id');
    }

    public function tasks() // Only for teachers
    {
        return $this->hasMany(Task::class, 'teacher_id');
    }

    public function submissions()
    {
        return $this->hasMany(TaskSubmission::class);
    }

    public function roles(): MorphToMany
    {
        return $this->morphToMany(Role::class, 'user', 'role_user');
    }

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    
}
