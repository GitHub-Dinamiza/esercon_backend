<?php

namespace App\Http\Resources;

use App\Http\Resources\Proyecto\CondicionesEconomicas;
use App\Http\Resources\Proyecto\CostoServisio;
use App\Http\Resources\Proyecto\GastoEstimado;
use App\Http\Resources\Proyecto\Recorrido;
use App\Http\Resources\Proyecto\TipoMaterial;
use App\Http\Resources\Proyecto\TipoVias;
use App\Models\Proyecto\GastoEstimadoProyecto;
use Illuminate\Http\Resources\Json\JsonResource;
use phpDocumentor\Reflection\Types\Collection;


class Proyecto extends JsonResource
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
            'nombre'=>$this->nombre,
            "codigo"=>$this->codigo,
            "fecha_inicio"=>$this->fecha_inicio ,
            "fecha_fin"=>$this->fecha_fin ,
            "municipio_inicio"=>$this->municipioInicial->nombre,
            "departamento_inicio_id" => $this->municipioInicial->departamento_id,
            "municipio_inicio_id"=>$this->municipio_inicio_id,

            "ubicacion_inicial"=>$this->ubicacion_inicial,
            "municipio_final"=>$this->municipioFinal->nombre ,
            "departamento_final_id"=>$this->municipioFinal->departamento_id,
            "municipio_final_id"=>$this->municipio_final_id,
            "ubicacion_final"=>$this->ubicacion_final,
            "horas_laboral_dia"=>$this->horas_laboral_dia ,
            "temperatura"=>$this->temperatura ,
            "propietario_dobletroque"=>$this->propietario_dobletroque,
            "duracion_proyecto"=>$this->duracion_dias,
            "cantidad_vehiculo_propio"=>$this->cantidad_vehiculo_propio,
            "cantidad_vehiculo_alquilado"=>$this->cantidad_vehiculo_alquilado,
            "valor_metrocubico_propio"=>$this->valor_metrocubico_propio,
            "valor_metrocubico_alquilado"=>$this->valor_metrocubico_alquilado,
            "valor_contrato"=>$this->valor_contrato,
            "valor_anticipo_contrato"=>$this->valor_anticipo_contrato,
            "antiguedad_vehiculo"=>$this->antiguedad_vehiculos_anios,
            "otros_requerimientos"=>$this->otro_requerimientos,


            "estado"=>$this->estado ,

            "usuario"=>$this->user->name ,

            "fecha_creacion"=>$this->created_at ,
            "fecha_atualizacion"=>$this->updated_at ,
            "contratos"=>DocumentoResource::collection($this->archivos),

            "tipo_vias"=>TipoVias::collection($this->tipoVia),

            "rellenos"=>TipoMaterial::collection($this->tipoMaterial),

            "costo_servicio"=>CostoServisio::collection($this->servicioCosto),

            "condicones_economicas"=>CondicionesEconomicas::collection($this->condicionesEconomicas),

            "consumo_gasto_estimado"=>GastoEstimado::collection($this->gastoEstimado),

            "recorrido"=>Recorrido::collection($this->recorrido)
        ];
    }
}
