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
        $asigConductor =AsignacionConductor::where(
            'vehiculo_id',$this->vehiculo_id)->first();
        if($asigConductor !=[]){
            $conductor = $asigConductor->conductor->nombreCompleto();
            $conductorId = $asigConductor->conductor->id;
        }else{
            $conductor ="No asignado";

        }

        return [
            "id"=>$this->id,
            "proyecto_id"=>$this->proyecto_id,
            "proyecto"=>$this->proyecto->nombre,
            "vehiculo_id"=>$this->vehiculo_id,
            "vehiculo"=>$this->vehiculo->placa,
            "modelo"=>$this->vehiculo->modelo->modelo
            ,"modelo_id"=>$this->vehiculo->modelo->id
            ,"marca"=>$this->vehiculo->modelo->marcaVehiculo->name
            ,"proveedor"=>$this->vehiculo->proveedor->razon_social
            ,"conductor"=>$conductor
            ,"conductor_id"=>$conductorId
            ,"estado"=>""
            ,"created_at"=>$this->created_at
            ,"updated_at"=>$this->updated_at
        ];
    }
}
