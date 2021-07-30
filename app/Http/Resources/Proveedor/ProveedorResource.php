<?php

namespace App\Http\Resources\Proveedor;


use Faker\Documentor;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

class ProveedorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)

    {

       /* $tipoDocumento = new Collection([
            'numero'=>  $this->numeroDocumento->numero,
            'tipo_documento'=> $this->numeroDocumento->tipoDocumento->nombre
        ]);*/
        return [
            'id'=>$this->id,
            'razon_social'=>$this->razon_social,
            'primer_nombre'=>$this->primer_nombre,
            'primer_apellido'=>$this->primer_apellido,
            'segundo_nombre'=>$this->segundo_nombre,
            'segundo_apellido'=>$this->segundo_apellido,
            'tipo_proveedor'=>$this->tipo_proveedor,
            'direccion'=>$this->direccion ,
            'telefono'=>$this->telefono,
            'email'=>$this->email,
            'municipio_id'=>$this->municipio_id,
            'municipio'=>$this->municipio->nombre,
            'departamento_id'=>$this->municipio->departamento_id,
            'user_id'=>$this->user_id,
            'numeros_identicacion'=>DocumentoProveedorResource::collection($this->numeroDocumento)

        ];
    }
}
