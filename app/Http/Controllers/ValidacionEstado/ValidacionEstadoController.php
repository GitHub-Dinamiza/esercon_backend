<?php

namespace App\Http\Controllers\ValidacionEstado;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController;
use App\Http\Resources\ValidacionDocumentoResource;
use App\Models\Proveedor;
use App\Models\ValidacionEstado\ValidacionDocumentacion;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ValidacionEstadoController extends Controller
{

    public function modeloComparar ($tipoArchivo){

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
    public function comparaLista($model, $tipoArchivo){


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



    public function ActivarPorDocumentacion (){

        $modelo = Proveedor::find(1);

        $lengData  =$this->comparaLista($modelo, 'tipo_archivo');

        if($lengData->count()>0 && $modelo->estado == 3){
            $modelo->update([
                'estado'=>'1'
            ]);
        }

        return response();
    }
}
