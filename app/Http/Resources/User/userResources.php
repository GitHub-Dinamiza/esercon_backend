<?php

namespace App\Http\Resources\User;

use App\Models\Departamento;
use App\Models\Municipio;
use App\Models\Provedores\Proveedor;
use Illuminate\Http\Resources\Json\JsonResource;

class userResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);

        if($this->persona != []){

            $municipio = Municipio::find($this->persona->ciudad_residencia_id);
            $departamento = Departamento::find($municipio->departamento_id);
            $proveedor = Proveedor::find($this->proveedor_id);

            $p = [
                'primer_nombre'=>$this->persona->primer_nombre,
                'segundo_nombre'=>$this->persona->segundo_nombre,
                'primer_apellido'=>$this->persona->primer_apellido,
                'segundo_apellido'=>$this->persona->segundo_apellido,
                'tipo_documento_id'=>$this->persona->tipo_documento_id,
                'tipo_documento'=>$this->persona->tipoDocumento->codigo,
                'tipo_documento_descripcion'=>$this->persona->tipoDocumento->descripcion_corta,

                'numero_documento'=>$this->persona->numero_documento,

                'ciudad_residencia_id'=>$this->persona->ciudad_residencia_id,

                'direccion'=>$this->persona->direccion,
                'telefono'=>$this->persona->telefono,
                'email'=>$this->persona->email,
                'estado_civil'=>$this->persona->estado_civil,
                'tipo_sangle_id'=>$this->persona->tipo_sangle_id,

                'eps_id'=>$this->persona->eps_id,
                'eps'=>$this->persona->eps->name,
                'arl_id'=>$this->persona->arl_id,
                'arl'=>$this->persona->arl->name,

                'departamento_residencia_id'=>$municipio->departamento_id,
                'departamento_residencia'=>$departamento->nombre,
                'ciudad_residencia'=>$municipio->nombre,
            ];
        }else{
            $p = [
                'primer_nombre'=>"",
                'segundo_nombre'=>"",
                'primer_apellido'=>"",
                'segundo_apellido'=>"",
                'tipo_documento_id'=>"",
                'tipo_documento'=>"",
                'tipo_documento_descripcion'=>"",

                'numero_documento'=>"",

                'ciudad_residencia_id'=>"",
                'direccion'=>"",
                'telefono'=>"",
                'email'=>"",
                'estado_civil'=>"",
                'tipo_sangle_id'=>"",

                'eps_id'=>"",
                'eps'=>"",
                'arl_id'=>"",
                'arl'=>"",

                'departamento_residencia_id'=>"",
                'departamento_residencia'=>"",
                'ciudad_residencia_id'=>"",
                'ciudad_residencia'=>"",
            ];
        }
//dd($p);
        return [

            'id'=>$this->id,

            "name"=>$this->name,
            "nick_name"=>$this->email,

            'primer_nombre'=>$p["primer_nombre"],
            'segundo_nombre'=>$p["segundo_nombre"],
            'primer_apellido'=>$p["primer_apellido"],
            'segundo_apellido'=>$p["segundo_apellido"],
            'tipo_documento_id'=>$p["tipo_documento_id"],
            'tipo_documento'=>$p["tipo_documento"],
            'tipo_documento_descripcion'=>$p["tipo_documento_descripcion"],

            'numero_documento'=>$p["numero_documento"],
            'departamento_residencia_id'=>$p["departamento_residencia_id"],
            'departamento_residencia'=>$p["departamento_residencia"],
            'ciudad_residencia_id'=>$p["ciudad_residencia_id"],
            'ciudad_residencia'=>$p["ciudad_residencia"],
            'direccion'=>$p["direccion"],
            'telefono'=>$p["telefono"],
            'email'=>$p["email"],
            'estado_civil'=>$p["estado_civil"],
            'tipo_sangle_id'=>$p["tipo_sangle_id"],

            'eps_id'=>$p["eps_id"],
            'eps'=>$p["eps"],
            'arl_id'=>$p["arl_id"],
            'arl'=>$p["arl"],

        ];

    }
}
