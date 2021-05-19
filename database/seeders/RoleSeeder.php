<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            //id 1
            "name"=>"desarrollador - todos los permisos",
            "slug"=>"dev"
        ]);

        Role::create([
            //id 2
            "name"=>"Administrador",
            "slug"=>"admin"
        ]);

        Role::create([
            //id 3
            "name"=>"Gerencia",
            "slug"=>"gerencia"
        ]);

    }
}
