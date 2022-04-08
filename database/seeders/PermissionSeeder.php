<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions and give them to admin
        $permissions = [

            'permission_access',
            'permission_show',
            'permission_grant',
            'permission_revoke',

            'role_access',
            'role_show',
            'role_create',
            'role_edit',
            'role_delete',
            'role_grant',
            'role_revoke',

            'user_access',
            'user_count',
            'user_delete',

            'project_access',
            'project_show',
            'project_create',
            'project_update',
            'project_delete',
            'project_search',

        ];

        foreach ($permissions as $permission)   {
            Permission::create([
                'name' => $permission
            ]);
        }

        // create Admin Role
        $Admin = Role::create(['name' => 'Admin']);
        
        
        foreach ($permissions as $permission)   {
            $Admin->givePermissionTo($permission);
        }
        
        // asign Admin Role to first user
        $admin = User::where('id' , 1)->first();
        $admin->assignRole('Admin');


        $User = Role::create(['name' => 'User']);

        // create User permissions
        $permissions = [
            'project_access',
            'project_show',
            'project_search',
        ];

        foreach ($permissions as $permission)   {
            $User->givePermissionTo($permission);
        }
    }
}
