<?php

namespace Database\Factories\Persona;

use App\Models\Persona\Conductor;
use App\Models\Persona\Persona;
use App\Models\Provedores\Proveedor;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConductorFactory extends Factory
{

    protected $model=Conductor::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'persona_id' =>Persona::factory()
            ,'proveedor_id'=>Proveedor::pluck('id')->random()
            ,'nombre_contacto'=>$this->faker->name
            ,'telefono_contacto'=>$this->faker->phoneNumber
            ,'estado_id' =>38
        ];
    }
}
