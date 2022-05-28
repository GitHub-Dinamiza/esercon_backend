<?php

namespace App\Http\Controllers\AsignacionRecurso;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController;
use App\Http\Resources\AsignacioRecurso\AsignacionRecursoResource;
use App\Models\AsignacionRecurso\AsignacionRecurso;
use Illuminate\Http\Request;

class AsignacionRecursoController extends Controller
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
            $asignacion = AsignacionRecurso::create([
                'vehiculo_id'=>$request->vehiculo_id,
                'proyecto_id'=>$request->proyecto_id,

            ]);
            ResponseController::set_messages('se signo el vehiculo');
            ResponseController::set_data([''=>$asignacion]);
            return ResponseController::response('OK');
        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');
    }



    public function  getAsignacionProyecto(Request $request){
        if($request->user()->can('add_proveedor')) {
            $asignacion = AsignacionConductorController::all();
        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');
    }



    public  function getAsignacionAll(Request $request, $proyecto_id){
        if (!$request) {
            ResponseController::set_errors(true);
            ResponseController::set_messages('Error en la asignacion');
            return ResponseController::response('BAD REQUEST');
        }
        if($request->user()->can('add_proveedor')) {
            $asignacion = AsignacionRecurso::where('proyecto_id',$proyecto_id)->get();
            $asignacion =  AsignacionRecursoResource::collection($asignacion);

            ResponseController::set_data(['Recursos'=>$asignacion]);
            return ResponseController::response('OK');
        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');
    }



    public function delete(Request $request, $id){
        if($request->user()->can('add_proveedor')) {
            $asignacion = AsignacionConductorController::find($id);
            $asignacion->delete();
            esponseController::set_messages('asignacion eliminada');
            return ResponseController::response('OK');
        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');
    }
}
