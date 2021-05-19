<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //roles permiso
        $permission = Permission::all();
        $rol =Role::find(1);

        foreach ($permission as $index=>$p){
            $rol->permissions()->attach($p->id);
        }

        $user = User::find(1);

        $user->roles()->attach($rol->id);
    }
}
