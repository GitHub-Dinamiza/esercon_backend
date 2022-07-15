<?php

namespace Database\Seeders;

use App\Models\Provedores\DocumentoProveedor;
use App\Models\Provedores\Proveedor;
use Illuminate\Database\Seeder;

class ProveedoreSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DocumentoProveedor::factory()->count(50)->create();
    }
}
