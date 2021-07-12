<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Proyecto\NombreCondicionesEconomica;
use App\Models\Servicio;

class CondecionesEconomicasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

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
    }
}
