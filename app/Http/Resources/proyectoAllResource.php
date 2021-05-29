<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class proyectoAllResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'nombre'=>$this->nombre,
            "codigo"=>$this->codigo,
            "fecha inicio"=>$this->fecha_inicio ,
            "fecha fin"=>$this->fecha_fin ,
            "municipio inicio"=>$this->municipioInicial->nombre,
            "ubicacion inicial"=>$this->ubicacion_inicial,
            "municipio final"=>$this->municipioFinal->nombre ,
            "ubicacion final"=>$this->ubicacion_final,
            "horas laboral dia"=>$this->horas_laboral_dia ,
            "temperatura"=>$this->temperatura ,
            "estado"=>$this->estado ,

            "usuario"=>$this->user->name ,

            "fecha de creacion"=>$this->created_at ,
            "fecha de atualizacion"=>$this->updated_at ,
        ];
    }
}
