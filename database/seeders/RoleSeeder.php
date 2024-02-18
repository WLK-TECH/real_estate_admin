<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = Role::create(["name"=> "user", "guard_name"=> "web"]);
        $admin = Role::create(["name"=> "admin", "guard_name"=> "web"]);
        $superAdmin = Role::create(["name"=> "super admin", "guard_name"=> "web"]);

        $list_super_admins = Permission::create(["name"=> "list super_admins"]);
        $list_admins = Permission::create(["name"=> "list admins"]);
        $list_users = Permission::create(["name"=> "list users"]);
        $create_users = Permission::create(["name"=> "create users"]);
        $edit_users = Permission::create(["name"=> "edit users"]);
        $delete_users = Permission::create(["name"=> "delete users"]);
        $list_roles = Permission::create(["name"=> "list roles"]);
        $create_roles = Permission::create(["name"=> "create roles"]);
        $edit_roles = Permission::create(["name"=> "edit roles"]);
        $delete_roles = Permission::create(["name"=> "delete roles"]);
        $list_permissions = Permission::create(["name"=> "list permissions"]);
        $create_permissions = Permission::create(["name"=> "create permissions"]);
        $edit_permissions = Permission::create(["name"=> "edit permissions"]);
        $delete_permissions = Permission::create(["name"=> "delete permissions"]);

        $superAdminPermissions = [
            $list_super_admins,
            $list_admins,
            $list_users,
            $create_users,
            $edit_users,
            $delete_users,
            $list_roles,
            $create_roles,
            $edit_roles,
            $delete_roles,
            $list_permissions,
            $create_permissions,
            $edit_permissions,
            $delete_permissions,
        ];

        $adminPermissions = [
            $list_admins,
            $list_users,
            $create_users,
            $edit_users,
            $delete_users,
        ];

        $admin->syncPermissions($adminPermissions);
        $superAdmin->syncPermissions($superAdminPermissions);
    }
}
