<?php

namespace App\Http\Resources\Operaciones;


use App\Models\Persona\Persona;
use App\Models\Proyecto;
use App\Models\Vehiculo\Vehiculos;
use Illuminate\Http\Resources\Json\JsonResource;

class RevisonConsolidadoResource extends JsonResource
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
        $vehiculo = Vehiculos::find($this->vehiculo_id);
        $persona  = Persona::find($this->responsable_id);
        //$asignacion = AsignacionRecurso::where('vehiculo_id',$this->vehiculo_id);
        $proyecto = Proyecto::find($this->proyecto_id);

        return [
            'fecha'=>$this->fecha_revision,
            'hora'=>$this->hora,
            'placa_vehiculo'=>$vehiculo->placa,
            'proyecto'=>$proyecto->nombre,
            'responsable'=>$persona->primer_nombre.' '.$persona->primer_apllido.' '.$persona->segundo_apellido

        ];
    }
}

