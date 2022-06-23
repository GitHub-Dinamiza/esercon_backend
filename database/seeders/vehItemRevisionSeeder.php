<?php

namespace Database\Seeders;

use App\Models\Operaciones\VehItemRevisionModel;
use Illuminate\Database\Seeder;

class vehItemRevisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['nombre'=>'Encendido',
             'tipo_dato'=>'Boolean'],

            ['nombre'=>'parabrisa delantero',
             'tipo_dato'=>'Boolean'],

            ['nombre'=>'parabrisa trasero',
             'tipo_dato'=>'Boolean'],

            ['nombre'=>'retrovisor izquiesdo',
             'tipo_dato'=>'Boolean'],

            ['nombre'=>'retrovisor derecho',
             'tipo_dato'=>'Boolean'],

            ['nombre'=>'Vidrio puerta Derecha',
             'tipo_dato'=>'Boolean'],

            ['nombre'=>'Vidrio Puerta Izquierdo',
             'tipo_dato'=>'Boolean'],

            ['nombre'=>'acta_revision',
             'tipo_dato'=>'Boolean'],

            ['nombre'=>'Puerta Izquierda',
             'tipo_dato'=>'Boolean'],

            ['nombre'=>'Corneta',
             'tipo_dato'=>'Boolean'],

            ['nombre'=>'Aire Acondicionado',
             'tipo_dato'=>'Boolean'],

            ['nombre'=>'Aceite',
             'tipo_dato'=>'Boolean'],

            ['nombre'=>'Refrigerante',
             'tipo_dato'=>'Boolean'],

            ['nombre'=>'Sistemas Hidraulico',
             'tipo_dato'=>'Boolean']
                ];
        foreach ($data as $index=>$d){
            VehItemRevisionModel::create([
                'nombre'=>$d['nombre'],
                'tipo_dato'=>$d['tipo_dato']
            ]);
        }

    }
}
