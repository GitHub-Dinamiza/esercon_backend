<?php

namespace App\Http\Controllers\AsignacionRecurso;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController;
use App\Http\Resources\AsignacioRecurso\AsignacionConductoresResource;
use App\Models\AsignacionRecurso\AsignacionConductor;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Collection;

class AsignacionConductorController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api');
    }

    public function asignacion(Request $request){
        if (!$request) {
            ResponseController::set_errors(true);
            ResponseController::set_messages('Error en la asignacion');
            return ResponseController::response('BAD REQUEST');
        }
        if($request->user()->can('add_proveedor')) {
            $validar =AsignacionConductor::where('vehiculo_id',$request->vehiculo_id)
                ->where('conductor_id',$request->conductor_id)
                ->where('state',true)->get();
            if(!$validar){
                $asignacion = AsignacionConductor::create([
                    'conductor_id'=>$request->conductor_id,
                    'vehiculo_id'=>$request->vehiculo_id,
                    'comentario'=>$request->comentario
                ]);
            }else{
                ResponseController::set_errors(true);
                ResponseController::set_messages('Ya se encuentra registrado el conductor');
                return ResponseController::response('BAD REQUEST');
            }

            ResponseController::set_messages('se asigno conductor');
            ResponseController::set_data([''=>$asignacion]);
            return ResponseController::response('OK');
        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');
    }

    public function getAsignacionAll(Request $request){
        if($request->user()->can('add_proveedor')) {
            $asignacion = AsignacionConductor::all();
            $asignacion =AsignacionConductoresResource::collection($asignacion);
            ResponseController::set_data(['asignacion'=>$asignacion]);
            return ResponseController::response('OK');
        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');
    }

    public function getAsignacion(Request $request){
        if($request->user()->can('add_proveedor')) {
            $asignacion = AsignacionConductorController::create([

            ]);


        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');
    }

    public function delete(Request $request,$id){
        if($request->user()->can('add_proveedor')) {
            $asignacion = AsignacionConductor::find($id);
            $asignacion->delete();

            ResponseController::set_messages('asignacion eliminado');
            return ResponseController::response('OK');
        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');
    }
}
