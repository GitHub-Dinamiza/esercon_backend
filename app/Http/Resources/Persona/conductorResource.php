<?php

namespace App\Http\Resources\Persona;

use App\Models\Municipio;
use Illuminate\Http\Resources\Json\JsonResource;

class conductorResource extends JsonResource
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
        $departamento = Municipio::find($this->persona->ciudad_residencia_id);
        return [

            'id'=>$this->persona->id,

            'primer_nombre'=>$this->persona->primer_nombre,
            'segundo_nombre'=>$this->persona->segundo_nombre,
            'primer_apellido'=>$this->persona->primer_apellido,
            'segundo_apellido'=>$this->persona->segundo_apellido,
            'tipo_documento_id'=>$this->persona->tipo_documento_id,
            'tipo_documento'=>$this->persona->tipoDocumento->codigo,
            'tipo_documento_descripcion'=>$this->persona->tipoDocumento->descripcion_corta,

            'numero_documento'=>$this->persona->numero_documento,
            'departamento_residencia_id'=>$departamento->departamento_id,
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
            'proveedor_id'=>$this->proveedor_id,

            'nombre_contacto'=>$this->nombre_contacto,
            'telefono_contacto'=>$this->telefono_contacto,
            'experiencia_laboral'=>ExperienciaLaboraResource::collection($this->persona->experienciaLaboral),
            'archivos'=>ArchivoPersonanResource::collection($this->persona->Archivo),
            'conductor_persona_id'=>$this->id

        ];
    }
}
