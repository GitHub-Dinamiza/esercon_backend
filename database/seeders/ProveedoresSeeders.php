<?php

namespace Database\Seeders;

use App\Models\Provedores\DocumentoProveedor;
use App\Models\Provedores\Proveedor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProveedoresSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $proveedor = Proveedor::create([

                    'codigo'=>Str::random(8),
                    'razon_social' =>'Esercon',
                    'primer_nombre' => '',
                    'primer_apellido' => '',
                    'segundo_nombre' => '',
                    'segundo_apellido' => '',
                    'tipo_proveedor' => '1',// Juridico o natural
                    'direccion' => 'direccion',
                    'telefono' => '333333',
                    'email' => 'esercon@esercon.com',
                    'municipio_id' => '8001',
                    'user_id' => '1' // n

        ]);

        DocumentoProveedor::create([
                    'numero' => '00000001',
                    'tipodocumento_id' => '4',
                    'user_id' => '1', //no request
                    'proveedor_id' => $proveedor->id //no request
        ]);
    }
}
