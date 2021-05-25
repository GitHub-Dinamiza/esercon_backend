<?php

namespace Database\Seeders;

use App\Models\TipoDocumento;
use Illuminate\Database\Seeder;

class TipoDocumentosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        TipoDocumento::create(['codigo'=>'CC', 'descripcion_corta'=>'CEDULA DE CIUDADANIA', 'indicador'=>'pe']);
        TipoDocumento::create(['codigo'=>'CE', 'descripcion_corta'=>'CEDULA DE EXTRANJERIA','indicador'=>'pe']);
        TipoDocumento::create(['codigo'=>'NIP', 'descripcion_corta'=>'NUMERO DE IDENTIFICACION PERSONAL','indicador'=>'pe']);
        TipoDocumento::create(['codigo'=>'NIT', 'descripcion_corta'=>'NUMERO DE IDENTIFICACION','indicador'=>'pe']);
        TipoDocumento::create(['codigo'=>'PAP', 'descripcion_corta'=>'PASAPORTE','indicador'=>'pe']);
        TipoDocumento::create(['codigo'=>'RUT', 'descripcion_corta'=>'RIGISTRO UNICO TRIBUTARIO','indicador'=>'pe']);
        TipoDocumento::create(['codigo'=>'RC', 'descripcion_corta'=>'REGISTRO CIVIL DE NACIMIENTO','indicador'=>'pe']);
    }
}
