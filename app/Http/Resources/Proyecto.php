<?php

namespace App\Http\Resources;

use App\Http\Resources\Proyecto\CondicionesEconomicas;
use App\Http\Resources\Proyecto\CostoServisio;
use App\Http\Resources\Proyecto\Recorrido;
use App\Http\Resources\Proyecto\TipoMaterial;
use App\Http\Resources\Proyecto\TipoVias;

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
            "fecha inicio"=>$this->fecha_inicio ,
            "fecha fin"=>$this->fecha_fin ,
            "municipio inicio"=>$this->municipioInicial->nombre,
            "ubicacion inicial"=>$this->ubicacion_inicial,
            "municipio final"=>$this->municipioFinal->nombre ,
            "ubicacion final"=>$this->ubicacion_final,
            "horas laboral dia"=>$this->horas_laboral_dia ,
            "temperatura"=>$this->temperatura ,
            "propietario dobletroque"=>$this->propietario_dobletroque,
            "duracion proyecto"=>$this->duracion_dias,
            "cantidad vehiculo propio"=>$this->cantidad_vehiculo_propio,
            "cantidad vehiculo alquilado"=>$this->cantidad_vehiculo_alquilado,
            "valor metrocubico propio"=>$this->valor_metrocubico_propio,
            "valor metrocubico alquilado"=>$this->valor_metrocubico_alquilado,
            "valor contrato"=>$this->valor_contrato,
            "valor anticipo contrato"=>$this->valor_anticipo_contrato,
            "antiguedad_vehiculo"=>$this->antiguedad_vehiculos_anios. " Años",
            "otros_requerimientos"=>$this->otro_requerimientos,


            "estado"=>$this->estado ,

            "usuario"=>$this->user->name ,

            "fecha de creacion"=>$this->created_at ,
            "fecha de atualizacion"=>$this->updated_at ,
            "contratos"=>DocumentoResource::collection($this->archivos),

            "tipo vias"=>TipoVias::collection($this->tipoVia),

            "rellenos"=>TipoMaterial::collection($this->tipoMaterial),

            "costo servicio"=>CostoServisio::collection($this->servicioCosto),

            "condicones economicas"=>CondicionesEconomicas::collection($this->condicionesEconomicas),

            "datos operativos"=>Recorrido::collection($this->gastoEstimado->gastoEstimadoO->scopeDatosOperativos),

            "datos administracion"=>null,

            "recorrido"=>Recorrido::collection($this->recorrido)
        ];
    }
}
