<?php

namespace App\Http\Resources\Proyecto;

use Illuminate\Http\Resources\Json\JsonResource;

class Recorrido extends JsonResource
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
            'recorrido_inicio_id'=>$this->recorrido_inicio_id,
            'recorrido_inicio'=>$this->ubicacionInicial->nombre,
            'recorrido_final_id' => $this->recorrido_final_id,
            'recorrido_final'=> $this->ubicacionFinal->nombre,
           ' accion_id'=> $this->accion_id,
           'accion'=> $this->accion->nombre
        ];
    }
}
