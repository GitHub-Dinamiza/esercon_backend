<?php

namespace Database\Seeders;

use App\Models\ValidacionEstado\ValidacionArchivoEntidad;
use Illuminate\Database\Seeder;

class listValidacionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data =[
            [
                'eneral_data_id'=>'42',
                'entidad'=>'vehiculo',
                'valida_fecha'=>true
            ],
            [
                'eneral_data_id'=>'43',
                'entidad'=>'vehiculo',
                'valida_fecha'=>true
            ],
            [
                'eneral_data_id'=>'44',
                'entidad'=>'vehiculo',
                'valida_fecha'=>true
            ],
            [
                'eneral_data_id'=>'45',
                'entidad'=>'vehiculo',
                'valida_fecha'=>true
            ],
            [
                'eneral_data_id'=>'46',
                'entidad'=>'vehiculo',
                'valida_fecha'=>true
            ],
            [
                'eneral_data_id'=>'47',
                'entidad'=>'vehiculo',
                'valida_fecha'=>false
            ],
        ];

        foreach ($data as $index=>$d){
            ValidacionArchivoEntidad::create([

                'general_data_id'=>$d['eneral_data_id'],
                'entidad'=>$d['entidad'],
                'valida_fecha'=>$d['valida_fecha']
            ]);
        }

    }
}
