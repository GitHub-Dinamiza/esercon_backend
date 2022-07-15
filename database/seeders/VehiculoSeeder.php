<?php

namespace Database\Seeders;

use App\Models\CarecteristicaVehiculo;
use App\Models\Vehiculo\Vehiculos;
use Database\Factories\Vehiculo\VehiculoModeloFactory;
use Illuminate\Database\Seeder;

class VehiculoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $data =[
            ['nombre'=>'Señalizacion Reflectivas',
             'tipo_documento'=>'boolean'],

             ['nombre'=>'Luz de licuadora de cabina',
             'tipo_documento'=>'boolean'],

             ['nombre'=>'Llantas de repuesto',
             'tipo_documento'=>'boolean'],

             ['nombre'=>'Herramientas basicas',
             'tipo_documento'=>'boolean'],


             ['nombre'=>'Aire acondicionado',
             'tipo_documento'=>'boolean'],

             ['nombre'=>'Botiquin primero auxilios',
             'tipo_documento'=>'boolean'],

             ['nombre'=>'Kit de derrame',
             'tipo_documento'=>'boolean'],

             ['nombre'=>'Kit de carretera',
             'tipo_documento'=>'boolean'],

             ['nombre'=>'Pito de reserva',
             'tipo_documento'=>'boolean'],

             ['nombre'=>'Extintor',
             'tipo_documento'=>'boolean'],

        ];

        foreach ($data as $index=>$d){

            CarecteristicaVehiculo::create([
                'nombre'=>$d['nombre'],
                'tipo_dato'=>$d['tipo_documento']
            ]);
        }
        $modelo = new VehiculoModeloFactory;

        $modelo->count(20)->create();
        Vehiculos::factory()->count(100)->create();
    }
}
