<?php

namespace Database\Factories\Provedores;

use App\Models\Provedores\DocumentoProveedor;
use App\Models\Provedores\Proveedor;
use Illuminate\Database\Eloquent\Factories\Factory;


class DocumentoProveedorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DocumentoProveedor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'numero'=>$this->faker->unique()-> randomNumber(9,true)
            ,'tipodocumento_id'=>4
            ,'user_id'=>1
            ,'proveedor_id'=>Proveedor::factory()
        ];
    }
}
