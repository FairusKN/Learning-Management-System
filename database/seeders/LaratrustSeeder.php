<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LaratrustSeeder extends Seeder
{
    public function run(): void
    {
        $rolesWithPermissions = [
            'admin' => ['manage users', 'grade assignments', 'submit assignments'],
            'teacher' => ['grade assignments', 'make assignments'],
            'student' => ['submit assignments'],
        ];

        foreach ($rolesWithPermissions as $roleName => $permissions) {
            $role = Role::firstOrCreate(['name' => $roleName]);
        
            $permissionIds = [];
            foreach ($permissions as $perm) {
                $permission = Permission::firstOrCreate(['name' => $perm]);
                $permissionIds[] = $permission->id;
            }
         
            $role->syncPermissions($permissionIds);
        }
    }
}
