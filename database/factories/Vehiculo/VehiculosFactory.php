<?php

namespace Database\Factories\Vehiculo;

use App\Models\Model;
use App\Models\Provedores\Proveedor;
use App\Models\Vehiculo\TipoVehiculo;
use App\Models\Vehiculo\Vehiculos;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehiculosFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vehiculos::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'placa'=>$this->faker->unique()->regexify('[A-Z]{5}[0-4]{3}')
            ,'tipo_vehiculo_id'=>TipoVehiculo::pluck('id')->random()
            ,'capacidad_volco_m3'=>$this->faker->numberBetween(200,350)
            ,'proveedor_id'=>Proveedor::pluck('id')->random()

            ,'tiene_zorro' =>true
            ,'capacidad_zorro'=> $this->faker->numberBetween(100,270)
        ];
    }
}
