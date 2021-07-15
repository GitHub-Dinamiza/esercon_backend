<?php

namespace Database\Seeders;

use App\Models\Proyecto\AccionRecorrido;
use App\Models\Proyecto\clasificacion_ubicacion;
use App\Models\Proyecto\RecorridoProyecto;
use Illuminate\Database\Seeder;

class RecorridoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $classicacionUbicacion = [
            ['nombre'=>'Cantera'],
            ['nombre'=>'Botadero'],
            ['nombre'=>'Obra']


        ];

        $recorridoUbicacion= [
                [
                    'nombre'=>'proyecto_1',
                    'direccion'=>'direccion proyecto 1',
                    'minicipio_id'=>'8001',
                    'clasificacion_id'=>'3',
                    'user_id'=>'1'
                ],
                [
                    'nombre'=>'botadero de escombros',
                    'direccion'=>'direccion botadero',
                    'minicipio_id'=>'8078',
                    'clasificacion_id'=>'2',
                    'user_id'=>'1'
                ],
                [
                    'nombre'=>'contera doña juana',
                    'direccion'=>'Direccion doña juana',
                    'minicipio_id'=>'8141',
                    'clasificacion_id'=>'1',
                    'user_id'=>'1'
                 ]
        ];



        foreach($classicacionUbicacion as $index=>$d){

            clasificacion_ubicacion::create([
                'nombre'=>$d["nombre"]
            ]);
        }
        foreach ($recorridoUbicacion as $index =>$d){
            RecorridoProyecto::create([
                    'nombre'=>$d["nombre"],
                    'direccion'=>$d["direccion"],
                    'municipio_id'=>$d["minicipio_id"],
                    'clasificacion_id'=>$d["clasificacion_id"],
                    'user_id'=>$d["user_id"]
            ]);
        }

        AccionRecorrido::create([
            'nombre'=>'Cargar'
        ]);
        AccionRecorrido::create([
            'nombre'=>'Descargar'
        ]);
    }
}
