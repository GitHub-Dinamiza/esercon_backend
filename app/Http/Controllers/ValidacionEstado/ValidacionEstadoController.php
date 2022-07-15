<?php

namespace App\Http\Controllers\ValidacionEstado;

use App\Http\Controllers\Controller;
use App\Http\Resources\ValidacionDocumentoResource;
use App\Models\Vehiculo\Vehiculos;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class ValidacionEstadoController extends Controller
{

    private function modeloComparar ($tipoArchivo){

        //$requestMA = $modeloArchivo->get();
        $m1 = DB::table('validacion_documentacions')
                ->join('general_data','validacion_documentacions.documento_id','=','general_data.id')
                ->where('general_data.table_iden',$tipoArchivo)
                ->get();

        $ma = ValidacionDocumentoResource::collection($m1);
        $re= new Collection($ma);
        return $re;
    }


    private function  modeloArchivos($modelo){

       $m = $modelo->archivo()->get();
        $m1 = $m->map(function ($item,$key){
            return $item->generalData()->first();
        });

        $m1 = ValidacionDocumentoResource::collection($m1);
        $re= new Collection($m1);
        return $re;
    }

/**
 * retun Collection
 */
    private function comparaLista($model, $tipoArchivo){


        $m1 = $this->modeloComparar($tipoArchivo);
        $mo = $this->modeloArchivos($model);

        $s1 = $this->lisIdDocument($m1);
        $s2 = $this->lisIdDocument($mo);
        $r = $s1->diff($s2);

        return $r;
    }

    private function lisIdDocument($modelo){


      $d = $modelo->mapWithKeys(function ($item, $key){
          return [$key =>$item["name"]];
      });

       return $d;
    }



    public  function ActivarPorDocumentacion ($modelo, $tipoArchivo){

        //$modelo = Proveedor::find(1);

        $lengData  =$this->comparaLista($modelo,  $tipoArchivo);

        $data=['mensaje_estado'=>'Todos los documentos cargado'];
        //dd($modelo->estado_id == 3);

        if($lengData->count()==0 && $modelo->estado_id == 3){
            $modelo->estado_id=1;
            $modelo->save();

            $data= [
                'mensaje_estado'=>'Se han cargado todo los documentos correctamente ',
                'registro'=>$modelo
            ];
        }elseif($lengData->count()>0){
            $data= [
                'mensaje_estado'=>[
                    'Documento_faltantes'=>$lengData]
            ];
            if($modelo->estado_id == 1){
                $modelo->estado_id=3;
                $modelo->save();
            }


        }

        return $data;
    }

    public function cambiar_estado(){

    }

    public function prueba(){
        $model =Vehiculos::find(1);
        $r = $this->comparaLista($model, 'tipo_archivo_vehiculo');
        //$a =  $this->modeloArchivos($model);
        return response($r);
    }
}
