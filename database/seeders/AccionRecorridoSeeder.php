<?php

namespace Database\Seeders;

use App\Models\Proyecto\AccionRecorrido;
use Illuminate\Database\Seeder;

class AccionRecorridoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dato = [
            ['nombre'=>'Carga'],
            ['nombre'=>'Descargar']

        ];

        foreach ($dato as $index => $d){
            AccionRecorrido::create([
                'nombre'=>$d["nombre"]
            ]);
        }
    }
}
