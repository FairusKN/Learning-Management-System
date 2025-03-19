<?php

namespace App\Models;

use Laratrust\Models\Role as RoleModel;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Role extends RoleModel
{
    public $guarded = [];

    public function users(): MorphToMany
    {
        return $this->morphedByMany(User::class, 'user', 'role_user');
    }
}
