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
        if($conductor !=[]){
            $conductorid =[
                "primer_nombre" => $conductor->conductor->persona->primer_nombre,
                "primer_apellido" =>$conductor->conductor->persona->primer_apellido,
                "segundo_apellido"=>$conductor->conductor->persona->segundo_apellid
            ];

        }else{
            $conductorid =[
                "primer_nombre" => "",
                "primer_apellido" =>"",
                "segundo_apellido"=>""
            ];
        }

        return [
            "id"=>$this->id,
            "proyecto_id"=>$this->proyecto_id,
            "proyecto"=>$this->proyecto->nombre,
            "vehiculo_id"=>$this->vehiculo_id,
            "vehiculo"=>$this->vehiculo->placa,
            "conductor"=>$conductorid["primer_nombre"]
                .' '.$conductorid["primer_apellido"]
                .' '.$conductorid["segundo_apellido"],
            "created_at"=>$this->created_at,
            "updated_at"=>$this->updated_at
        ];
    }
}
