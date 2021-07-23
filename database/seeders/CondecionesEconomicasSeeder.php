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
            ['nombre'=>'Lavado General', 'servicio_id'=>'3'],


            ['nombre'=>'Lavado Motor', 'servicio_id'=>'3'],
            ['nombre'=>'Lavado Debajo', 'servicio_id'=>'3'],
            ['nombre'=>'Hospedaje Noche', 'servicio_id'=>'5'],
            ['nombre'=>'Desayuno', 'servicio_id'=>'6'],
            ['nombre'=>'Almuerzo', 'servicio_id'=>'6'],
            ['nombre'=>'Cena', 'servicio_id'=>'6'],
            ['nombre'=>'Lubricacion semanal', 'servicio_id'=>'7'],
            ['nombre'=>'Lubricacion Dos veces por semana', 'servicio_id'=>'7'],
            ['nombre'=>'Lubricacion Quincena', 'servicio_id'=>'7'],
            ['nombre'=>'Despinchado por unidad', 'servicio_id'=>'8']

        ];

      Servicio::create([
        'nombre'=>'Parqueadero dobleTroque'
      ]);
      Servicio::create([
        'nombre'=>'Estacion de servicio'
      ]);
      Servicio::create([
        'nombre'=>'Lavado dobleTroque'
      ]);

      Servicio::create([
        'nombre'=>'otros'
      ]);

      Servicio::create([
        'nombre'=>'Gastos de hospedaje'
      ]);

      Servicio::create([
        'nombre'=>'Servicio de Alimentacion'
      ]);

      Servicio::create([
        'nombre'=>'Servicio de lubricacion'
      ]);

      Servicio::create([
        'nombre'=>'servicio de Despinchado'
      ]);

    ### Nombre Condiciones Economicas
        NombreCondicionesEconomica::create([
            'nombre'=>'Pago de certificaciones de vehículos'
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
            'nombre'=>'Pago de dotación'
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
