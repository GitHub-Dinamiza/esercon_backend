<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dato = [
            [
                'nombre'=>'ACTIVO',
                'descripcion'=>''
            ],
            [
                'nombre'=>'INACTIVO',
                'descripcion'=>''
            ],
            [
                'nombre'=>'INACTIVO_DOCUMENTACION',
                'descripcion'=>''
            ],


        ];

        foreach ($dato as $index => $d){

            DB::table('estados')->insert([
                'nombre'=>$d['nombre'],

            ]);
        }
    }
}
