<?php

namespace Database\Factories\Persona;

use App\Models\GeneralData;
use App\Models\Municipio;
use App\Models\Persona\Persona;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonaFactory extends Factory
{
    protected  $model = Persona::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'primer_nombre' =>$this->faker->firstName
            ,'segundo_nombre'=>$this->faker->firstName
            , 'primer_apellido'=>$this->faker->lastName
            , 'segundo_apellido'=>$this->faker->lastName
            , 'tipo_documento_id'=>1
            ,'numero_documento'=>$this->faker->unique()-> randomNumber(9,true)
            , 'ciudad_residencia_id'=> Municipio::pluck('id')->random()
            ,'direccion'=>$this->faker->address
            , 'telefono'=>$this->faker->phoneNumber
            ,'email'=>$this->faker->email
            ,'estado_civil'=>GeneralData::where('table_iden','estado_civil')
                ->pluck('id')->random()
            , 'tipo_sangle_id'=>GeneralData::where('table_iden','tipo_sangle')
                ->pluck('id')->random()
            ,'eps_id'=>GeneralData::where('table_iden','eps')
                ->pluck('id')->random()
            ,'arl_id'=>GeneralData::where('table_iden','arl')
                ->pluck('id')->random()
        ];
    }
}
