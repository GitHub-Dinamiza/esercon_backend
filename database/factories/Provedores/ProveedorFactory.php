<?php

namespace Database\Factories\Provedores;


use App\Models\Municipio;
use App\Models\Provedores\Proveedor;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProveedorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Proveedor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'razon_social'=>$this->faker->words(3,true)
            ,'codigo' =>$this->faker->unique()->regexify('[A-Z]{5}[0-4]{3}')
             //,'primer_nombre'
            //,'primer_apellido'
            //,'segundo_nombre'
           // ,'segundo_apellido'
            ,'tipo_proveedor' => true
            ,'direccion' => $this->faker->address
            ,'telefono' =>$this->faker->phoneNumber
            ,'email' =>$this->faker->email
            ,'municipio_id' => Municipio::pluck('id')->random()
            ,'user_id'=>1

        ];
    }
}
