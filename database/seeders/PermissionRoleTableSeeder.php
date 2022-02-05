<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        $all_permissions = Permission::all();
        Role::findOrFail(1)->permissions()->sync($all_permissions->pluck('id'));
        $user_permissions = $all_permissions->filter(function ($permission) {
            return substr($permission->title, 0, 5) != 'user_' && substr($permission->title, 0, 5) != 'role_' && substr($permission->title, 0, 11) != 'permission_';
        });
        Role::findOrFail(2)->permissions()->sync($user_permissions);
        
        //Additionally a customer shouldn't be able to create or edit anything except orders maybe, but those are not part of the perms
        $customer_permissions = $all_permissions->filter(function ($permission) {
            return substr(
                $permission->title, 0, 5) != 'user_' 
                && substr($permission->title, 0, 5) != 'role_' 
                && substr($permission->title, 0, 11) != 'permission_' 
                && !strpos($permission->title, 'create')  
                && !strpos($permission->title, 'edit')  
                && !strpos($permission->title, 'delete');
        });

        Role::findOrFail(3)->permissions()->sync($customer_permissions);
    }
}
