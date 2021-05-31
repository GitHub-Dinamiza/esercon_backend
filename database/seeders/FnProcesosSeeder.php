<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FnProcesosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seed[] = [
           'nombre'=>'contrato_asociado-proyecto',
           'tabla_entidad'=>'proyectos'
        ];

       DB::table('fn_procesos')->insert($seed);
    }
}
