<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = Role::create(['name' => 'Super Admin',  "guard_name"=>"admin"]);
        $admin = Role::create(['name' => 'Admin',  "guard_name"=>"admin"]);
        $user = Role::create(['name' => 'User',  "guard_name"=>"web"]);
        $this->addPostPermissions($superAdmin, $admin);
    }

    /**
     * @param Role $superAdmin
     * @param Role $admin
     */
    private function addPostPermissions(Role $superAdmin, Role $admin)
    {
        $permission = $this->createPermissions([
            "list post", "edit post", "details post",
            "create post", "delete post"
        ], "post");

        $superAdmin->givePermissionTo($permission);
        $admin->givePermissionTo($permission);
    }

    /**
     * @param array  $actions
     * @param string $group_name
     * @param string $guard_name
     * @return array
     */
    private function createPermissions(array $actions,  $group_name,  $guard_name = "admin")
    {
        $permissions = [];
        foreach ($actions as $action) {
            array_push($permissions, Permission::create([
                "name"       => $action,
                "guard_name" => $guard_name,
                "group_name" => $group_name
            ]));
        }

        return $permissions;
    }
}
