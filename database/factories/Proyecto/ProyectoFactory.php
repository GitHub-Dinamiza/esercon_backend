<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\Municipio;
use App\Models\Proyecto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProyectoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Proyecto::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
             'codigo'=>$this->faker->unique()->regexify('[A-Z]{5}[0-4]{3}')
            ,'nombre'=>$this->faker->unique()->words(2,)
            ,'fecha_inicio'=>$this->faker->date('now')
            ,'fecha_fin'=>$this->faker->date('now')
            ,'municipio_inicio_id'=>Municipio::pluck('id')->random()
            ,'ubicacion_inicial' => $this->faker->address
            ,'municipio_final_id'=>Municipio::pluck('id')->random()
            ,'ubicacion_final' => $this->faker->address
            ,'horas_laboral_dia'=>'8'
            ,'temperatura'=>'27'

            ,'user_id'=>1
            ,'propietario_dobletroque'=>'mixto'
            ,'duracion_dias'
            ,'cantidad_vehiculo_propio'
            ,'cantidad_vehiculo_alquilado'
            ,'valor_metrocubico_propio'
            ,'valor_metrocubico_alquilado'
            ,'valor_contrato'
            ,'valor_anticipo_contrato'
            ,'antiguedad_vehiculos_anios'
            ,'otro_requerimientos'
        ];
    }
}
