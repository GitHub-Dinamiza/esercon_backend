<?php

namespace Database\Seeders;

use App\Models\Departamento;
use App\Models\Municipio;
use Illuminate\Database\Seeder;

class LocalizacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departamentos = fopen(public_path('csv/departamentos.csv'),'r');
        $municipios= fopen(public_path('csv/municipios.csv'), 'r');
        while (($data = fgetcsv($departamentos))!== false){
            Departamento::create([
                'id'=>$data[1],
                'nombre'=>$data[2],
                'descripcion'=>$data[0]
            ]);
        }

        while (($data = fgetcsv($municipios))!== false){
            Municipio::create([
                'id'=>$data[1],
                'departamento_id'=>$data[0],
                'nombre'=>$data[2]
            ]);
        }
    }
}
