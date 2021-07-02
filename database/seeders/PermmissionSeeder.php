<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            //id 1
            "name"=>"Crear usuario ",
            "slug"=>"user-add"
        ]);
        Permission::create([
            //id 2
            "name"=>"Update Usuario",
            "slug"=>"user-update"
        ]);
        Permission::create([
            //id 3
            "name"=>"Consutar usurario",
            "slug"=>"user-get"
        ]);
        Permission::create([
//            //id 4
            "name"=>"Eliminar usuario",
            "slug"=>"user-delete"
        ]);
        Permission::create([
            "name"=>"consultar usuarion eliminados",
            "slug"=>"user-get-delete"
        ]);
        Permission::create([
            "name"=>"Restaurar usuario",
            "slug"=>"user-restore"
        ]);
        Permission::create([
            "name"=>"roles de usuario",
            "slug"=>"user-role"
        ]);
        Permission::create([
            "name"=>"Pemisos de ususario",
            "slug"=>"user-permission"
        ]);


        Permission::create([
            "name"=>"roles y permisos",
            "slug"=>"role-permission"
        ]);
        Permission::create([
            "name"=>"Restaurar roles y permisos",
            "slug"=>"role-permission-restore"
        ]);

        Permission::create([
            "name"=>"crear proyecto",
            "slug"=>"add_proyecto"
        ]);

        Permission::create([
            "name"=>"consulta proyecto",
            "slug"=>"show_proyecto"
        ]);

        Permission::create([
            "name"=>"actualizar proyecto",
            "slug"=>"update_proyecto"
        ]);

        Permission::create([
            "name"=>"eliminar proyecto",
            "slug"=>"delete_proyecto"
        ]);
#PROVERDOR
        Permission::create([
            "name"=>"crear proveedor",
            "slug"=>"add_proveedor"
        ]);

        Permission::create([
            "name"=>"actulizar proveedor",
            "slug"=>"update_proveedor"
        ]);
    }
}
