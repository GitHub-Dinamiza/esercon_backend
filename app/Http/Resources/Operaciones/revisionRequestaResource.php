<?php

namespace App\Http\Resources\Operaciones;

use Illuminate\Http\Resources\Json\JsonResource;

class revisionRequestaResource extends JsonResource
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
            "veh_item_revision_id"=>$this->veh_item_revision_id,
            "vehiculo_id"=>$this->vehiculo_id,
            "valor"=>$this->valor,
            "comentario"=>$this->comentario,
            "fecha_revision"=>$this->fecha_revision,
            "hora"=>$this->hora,
            "user_id"=>$this->user_id,
            "evidencia"=>$this->evidencia
        ];

    }
}
