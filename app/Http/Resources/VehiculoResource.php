<?php

namespace App\Http\Resources;

use App\Http\Resources\Vehiculo\ArchivosVehiculosResource;
use App\Http\Resources\Vehiculo\asignacionCarasteristicaVehiculosResource;

use App\Models\AsignacionRecurso\AsignacionConductor;
use App\Models\AsignacionRecurso\AsignacionRecurso;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

class VehiculoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = new Collection();
        $req = asignacionCarasteristicaVehiculosResource::collection($this->asignacionCarateristica);
        foreach($req as $index=>$d){

            $data = $data->union($d);
        }

      $Asigconductor =  AsignacionConductor::where('vehiculo_id',$this->id)->first();
        if(empty($Asigconductor )){
            $conductor = "no asinado";
            $conductorId ="no asinado";
        }else{

            $conductor = $Asigconductor->conductor->nombreCompleto();
            $conductorId = $Asigconductor->conductor_id;
        }
        $proyecto = AsignacionRecurso::where('vehiculo_id',$this->id)->first();
        if(empty($proyecto)){
            $proyecto= "no asinado";
        }else{
            $proyecto = $proyecto->proyecto->nombre;
        }
        if($this->estado_id != 38){
            $estado = false;
        }else{
            $estado = true;
        }
        return
        [
            'id'=>$this->id,
            'placa'=>$this->placa,
            'modelo_vehiculo_id'=>$this->tipo_vehiculo_id,
            'modelo'=>$this->modelo->modelo,
            'marca_id'=>$this->modelo->marca_id,
            'marca'=>$this->modelo->marcaVehiculo->name,
            'anio_fabricancion'=>$this->modelo->anio_fabricacion,
            'tiene_zorro'=>$this->tiene_zorro,
            'capacidad_zorro'=>$this->capacidad_zorro,
            'capacidad_volco'=>$this->capacidad_volco_m3,
            'propetario'=>$this->propietario,
            'proveedor_id'=>$this->proveedor_id,
            'proveedor'=>$this->proveedor->razon_social,
            'caracteristicas'=>$data,
            'estado'=>$estado,
            'conductor'=>$conductor,
            'conductor_id'=>$conductorId,
            'proyecto'=>$proyecto,
            'archivos'=>ArchivosVehiculosResource::collection($this->archivo)


        ];
    }
}
