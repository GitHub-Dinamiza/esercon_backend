<?php

namespace App\Http\Resources\Operaciones;

use App\Models\AsignacionRecurso\AsignacionConductor;
use App\Models\Proyecto;
use App\Models\TipoMaterial;
use App\Models\Vehiculos;
use Illuminate\Http\Resources\Json\JsonResource;

class OperacionesResource extends JsonResource
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
        $proyecto = Proyecto::find($this->proyecto_id);
        $vehiculo = Vehiculos::find($this->vehiculo_id);
        $material = TipoMaterial::find($this->tipo_materiales);
        $lugar = Proyecto\RecorridoProyecto::find($this->carga_lugar_id);
        $desLugar = Proyecto\RecorridoProyecto::find($this->desc_lugar_id);
        $estado = 'En proseso';
        $conductor = AsignacionConductor::where('vehiculo_id',$this->vehiculo_id );
        if(empty(!$conductor->first())){
            $conductor =  $conductor->conductor->persona->primer_nombre.' '
                          .$conductor->conductor->persona->segundo_nombre.' '
                          .$conductor->conductor->persona->primer_apellido.' '
                          .$conductor->conductor->persona->segundo_apellido;
        }else{
            $conductor = '';
        }
        if($this->estdo_id == 1){
            $estado = 'Terminado';
        }
        return [
            'vehiculo_id'=>$vehiculo->placa
            ,'conductor'=>$conductor
            ,'proyecto_id'=>$proyecto->nombre

            ,'tipo_materiales'=>$material->nombre
            ,'carga_fecha'=>$this->carga_fecha
            ,'carga_hora'=>$this->carga_hora
            ,'carga_lugar_id'=>$lugar->nombre
            ,'carga_metrocubicos'=>$this->carga_metrocubicos
            ,'carga_kilometraje'=>$this->carga_kilometraje
            ,'desc_fecha' =>$this->desc_fecha
            ,'desc_hora'=>$this->desc_hora
            ,'desc_lugar_id' => $desLugar->nombre
            ,'desc_metrocubicos'=>$this->desc_metrocubicos
            ,'desc_kilometraje'=>$this->desc_kilometraje
            ,'estdo_id'=>$this->estdo_id
            ,'id'=>$estado
        ];

    }
}
