<?php

namespace App\Http\Controllers\Operaciones;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController;
use App\Http\Resources\Operaciones\OperacionesResource;
use App\Models\AsignacionRecurso\AsignacionRecurso;
use App\Models\Operaciones\OperacionDiaria;
use Illuminate\Http\Request;

class OperacionDiariaController extends Controller
{
    //
    public function  __construct(){
        $this->middleware('auth:api');
    }

    public function store(Request  $request){
        if($request->user()->can('add_proveedor')){
            $estado = 0;
            if(
                $request->vehiculo_id != '' &&

                $request->tipo_materiales != '' &&
                $request->carga_fecha != '' &&
                $request->carga_hora != '' &&
                $request->carga_lugar_id != '' &&
                $request->carga_metrocubicos != '' &&
                $request->carga_kilometraje != '' &&
                $request->desc_fecha     != '' &&
                $request->desc_hora != '' &&
                $request->desc_lugar_id != '' &&
                $request->desc_metrocubicos != '' &&
                $request->desc_kilometraje != ''

            ){
                $estado = 1;
            }
            $proyecto = AsignacionRecurso::where('vehiculo_id',$request->vehiculo_id)
                ->where('state',true)->first();
            if(!empty($proyecto)) {
                $operacionDiaria = OperacionDiaria::create([
                    'vehiculo_id'=>$request->vehiculo_id
                    ,'proyecto_id'=>$proyecto->proyecto_id
                    ,'tipo_materiales'=>$request->tipo_materiales
                    ,'carga_fecha'=>$request->carga_fecha
                    ,'carga_hora'=>$request->carga_hora
                    ,'carga_lugar_id'=>$request->carga_lugar_id
                    ,'carga_metrocubicos'=>$request->carga_metrocubicos
                    ,'carga_kilometraje'=>$request->carga_kilometraje
                    ,'desc_fecha' =>$request->desc_fecha
                    ,'desc_hora'=>$request->desc_hora
                    ,'desc_lugar_id'=>$request->desc_lugar_id
                    ,'desc_metrocubicos'=>$request->desc_metrocubicos
                    ,'desc_kilometraje'=>$request->desc_kilometraje
                    ,'estdo_id'=>$estado
                ]);
            }else{
                ResponseController::set_errors(true);
                ResponseController::set_messages('vehiculo no asociado a proyecto');
                return ResponseController::response('UNAUTHORIZED');
            }

            $operacionDiaria = OperacionesResource::make($operacionDiaria);

            ResponseController::set_messages('registra agregado');
            ResponseController::set_data(['operacion'=>$operacionDiaria]);
            return ResponseController::response('OK');
        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');
    }
    public function getAll(Request  $request){
        if($request->user()->can('add_proveedor')){
            $operacionDiaria = OperacionDiaria::all();

            $operacionDiaria = OperacionesResource::collection($operacionDiaria);
            ResponseController::set_data(['operacion'=>$operacionDiaria]);
            return ResponseController::response('OK');

        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');
    }
    public function update(Request  $request, $id){
        if($request->user()->can('add_proveedor')){
            $estado = 0;
            if(
                $request->vehiculo_id != '' &&

                $request->tipo_materiales != '' &&
                $request->carga_fecha != '' &&
                $request->carga_hora != '' &&
                $request->carga_lugar_id != '' &&
                $request->carga_metrocubicos != '' &&
                $request->carga_kilometraje != '' &&
                $request->desc_fecha     != '' &&
                $request->desc_hora != '' &&
                $request->desc_metrocubicos != '' &&
                $request->desc_lugar_id != '' &&
                $request->desc_kilometraje != ''

            ){
                $estado = 1;
            }
            //dd($request);
            $operacionDiaria = OperacionDiaria::find($id);
            $operacionDiaria->update([
                'vehiculo_id'=>$request->vehiculo_id
                //,'proyecto_id'=>$request->proyecto_id
                ,'tipo_materiales'=>$request->tipo_materiales
                ,'carga_fecha'=>$request->carga_fecha
                ,'carga_hora'=>$request->carga_hora
                ,'carga_lugar_id'=>$request->carga_lugar_id
                ,'carga_metrocubicos'=>$request->carga_metrocubicos
                ,'carga_kilometraje'=>$request->carga_kilometraje
                ,'desc_fecha' =>$request->desc_fecha
                ,'desc_lugar_id'=>$request->desc_lugar_id
                ,'desc_hora'=>$request->desc_hora
                ,'desc_metrocubicos'=>$request->desc_metrocubicos
                ,'desc_kilometraje'=>$request->desc_kilometraje
                ,'estdo_id'=>$estado
            ]);

            $operacionDiaria = OperacionesResource::make($operacionDiaria);
            ResponseController::set_messages('registro actulizado');
            ResponseController::set_data(['operacion'=>$operacionDiaria]);
            return ResponseController::response('OK');
        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');
    }
    public function delete(Request  $request, $id){
        if($request->user()->can('add_proveedor')){
            $operacionDiaria = OperacionDiaria::find($id);
            $operacionDiaria->delete();
            ResponseController::set_messages('registro eliminado');

            return ResponseController::response('OK');
        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');
    }
}
