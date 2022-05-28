<?php

namespace App\Http\Resources\AsignacioRecurso;

use Illuminate\Http\Resources\Json\JsonResource;

class AsignacionConductoresResource extends JsonResource
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
        return [
            "id"=>$this->id,
            "vehiculo_id"=>$this->vehiculo_id,
            "placa_vehiculo"=>$this->vehiculo->placa,
            "conductor_id"=>$this->conductor_id,
            "conductor"=>$this->conductor->persona->primer_nombre
                .' '.$this->conductor->persona->primer_apellido
                .' '.$this->conductor->persona->segundo_apellido,
            "state"=>$this->state,
            "created_at"=>$this->created_at,
            "updated_at"=>$this->updated_at
        ];
    }
}
