<?php

namespace App\Http\Resources\AsignacioRecurso;

use App\Models\AsignacionRecurso\AsignacionConductor;
use Illuminate\Http\Resources\Json\JsonResource;

class AsignacionRecursoResource extends JsonResource
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
        $conductor =AsignacionConductor::where(
            'vehiculo_id',$this->vehiculo_id)->first();
        return [
            "id"=>$this->id,
            "proyecto_id"=>$this->proyecto_id,
            "proyecto"=>$this->proyecto->nombre,
            "vehiculo_id"=>$this->vehiculo_id,
            "vehiculo"=>$this->vehiculo->placa,
            "conductor"=>$conductor->conductor->persona->primer_nombre
                .' '.$conductor->conductor->persona->primer_apellido
                .' '.$conductor->conductor->persona->segundo_apellido,
            "created_at"=>$this->created_at,
            "updated_at"=>$this->updated_at
        ];
    }
}
