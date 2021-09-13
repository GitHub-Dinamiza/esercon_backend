<?php

namespace App\Http\Resources\Vehiculo;

use Illuminate\Http\Resources\Json\JsonResource;

class ArchivosVehiculosResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       // return parent::toArray($request);

       return [
           'id'=>$this->id,
           'nombre'=>$this->nombre,
           'tipo_archivo_vehiculo_id'=>$this->tipo_archivo_id,
           'nombre_tipo_archivo_vehiculo'=>$this->tipoArchivo->name,
           'ruta'=>$this->ruta,
           'extencion'=>$this->extension,
           'tamanio'=>$this->tamanio,
           'fecha_vencimiento'=>$this->fecha_espedicon,
           'usuario_creador'=>$this->user_id

       ];
    }
}
