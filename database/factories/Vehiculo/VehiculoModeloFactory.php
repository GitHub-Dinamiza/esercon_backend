<?php

namespace Database\Factories\Vehiculo;

use App\Models\GeneralData;
use App\Models\Model;
use App\Models\Vehiculo\TipoVehiculo;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehiculoModeloFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TipoVehiculo::class;

    /**+
     * @param $fecha
     * @return void
     */
    private  function  fecha($fecha){
        if(intval($fecha) <= 1995 && intval($fecha)>=2022 ){


            $this->fecha($this->faker->year());
        }
        return date($fecha);
    }
    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        return [
            'marca_id' =>GeneralData::where('table_iden','Marca_vehiculos')->pluck('id')->random()
            ,'modelo' =>$this->faker->words(2,true)
            ,'anio_fabricacion' => $this->fecha($this->faker->year())
        ];
    }
}
