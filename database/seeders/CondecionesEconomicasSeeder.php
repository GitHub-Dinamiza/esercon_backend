<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Proyecto\NombreCondicionesEconomica;
use App\Models\Servicio;
use App\Models\TipoCostoServicio;

class CondecionesEconomicasSeeder extends Seeder
{




    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $costo = [
            ['nombre'=>'Parqueadero por dia', 'servicio_id'=>'1'],

            ['nombre'=>'Galon de gasolina', 'servicio_id'=>'2'],
            ['nombre'=>'Galon de diesel', 'servicio_id'=>'2'],

            ['nombre'=>'Otros', 'servicio_id'=>'4'],
            ['nombre'=>'Lavado general', 'servicio_id'=>'3'],


            ['nombre'=>'Lavado motor', 'servicio_id'=>'3'],
            ['nombre'=>'Lavado debajo', 'servicio_id'=>'3'],
            ['nombre'=>'Hospedaje noche', 'servicio_id'=>'5'],
            ['nombre'=>'Desayuno', 'servicio_id'=>'6'],
            ['nombre'=>'Almuerzo', 'servicio_id'=>'6'],
            ['nombre'=>'Cena', 'servicio_id'=>'6'],
            ['nombre'=>'Lubricacion semanal', 'servicio_id'=>'7'],
            ['nombre'=>'Lubricacion dos veces por semana', 'servicio_id'=>'7'],
            ['nombre'=>'Lubricacion quincenal', 'servicio_id'=>'7'],
            ['nombre'=>'Despinchado por unidad', 'servicio_id'=>'8']

        ];

      Servicio::create([
        'nombre'=>'Parqueadero dobletroque'
      ]);
      Servicio::create([
        'nombre'=>'Estacion de servicio'
      ]);
      Servicio::create([
        'nombre'=>'Lavado dobletroque'
      ]);

      Servicio::create([
        'nombre'=>'Otros'
      ]);

      Servicio::create([
        'nombre'=>'Gastos de hospedaje'
      ]);

      Servicio::create([
        'nombre'=>'Servicio de alimentacion'
      ]);

      Servicio::create([
        'nombre'=>'Servicio de lubricacion'
      ]);

      Servicio::create([
        'nombre'=>'Servicio de despinchado'
      ]);

    ### Nombre Condiciones Economicas
        NombreCondicionesEconomica::create([
            'nombre'=>'Pago de certificaciones de vehiculos'
        ]);
        NombreCondicionesEconomica::create([
            'nombre'=>'Pago de refrigerante'
        ]);
        NombreCondicionesEconomica::create([
            'nombre'=>'Pago de conductor'
        ]);
        NombreCondicionesEconomica::create([
            'nombre'=>'Otros'
        ]);
        NombreCondicionesEconomica::create([
            'nombre'=>'Pago de dotacion'
        ]);

        foreach ($costo as $index=> $d)
        {
            TipoCostoServicio::create([
                'nombre'=>$d["nombre"],
                'servicio_id'=>$d["servicio_id"]
            ]);
        }
    }
}
