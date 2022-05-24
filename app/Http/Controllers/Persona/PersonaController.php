<?php

namespace App\Http\Controllers\Persona;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController;
use Illuminate\Http\Request;
use App\Models\Persona\Persona;

class PersonaController extends Controller
{
    public function  __contruct(){
        $this->middleware('auth:api');
    }


    public function store(Request $request){
        if($request->user()->can('add_proveedor')){

            $persona = Persona::create([
                'primer_nombre'=>$request->primer_nombre,
                'segundo_nombre'=>$request->segundo_nombre,
                'primer_apellido'=>$request->primer_apellido,
                'segundo_apellido'=>$request->segundo_apellido,
                'tipo_documento_id'=>$request->tipo_documento_id,
                'numero_documento'=>$request->numero_documento,
                'ciudad_residencia_id'=>$request->ciudad_residencia_id,
                'direccion'=>$request->direccion,
                'telefono'=>$request->telefono,
                'email'=>$request->email,
                'estado_civil'=>$request->estado_civil,
                'tipo_sangle_id'=>$request->tipo_sangle_id,
                'eps_id'=>$request->eps_id,
                'arl_id'=>$request->arl_id
            ]);

            ResponseController::set_messages('persona creado');
            ResponseController::set_data(['persona'=>$persona]);
            return ResponseController::response('OK');
        }

        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');

    }

    public  function get(Request $request){

        if($request->user()->can('add_proveedor')){

            $persona = Persona::all();

            ResponseController::set_data(['persona'=>$persona]);
            return ResponseController::response('OK');
        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');

    }

    public function getId(Request $request, $id){
        if($request->user()->can('add_proveedor')){
            $persona = Persona::find($id);
            ResponseController::set_data(['persona'=>$persona]);
            return ResponseController::response('OK');
        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');
    }

    public function update(Request $request, $id){
        if($request->user()->can('add_proveedor')) {

            $persona= Persona::find($id);


            $persona->update([
                'primer_nombre'=>$request->primer_nombre,
                'segundo_nombre'=>$request->segundo_nombre,
                'primer_apellido'=>$request->primer_apellido,
                'segundo_apellido'=>$request->segundo_apellido,
                'tipo_documento_id'=>$request->tipo_documento_id,
                'numero_documento'=>$request->numero_documento,
                'ciudad_residencia_id'=>$request->ciudad_residencia_id,
                'direccion'=>$request->direccion,
                'telefono'=>$request->telefono,
                'email'=>$request->email,
                'estado_civil'=>$request->estado_civil,
                'tipo_sangle_id'=>$request->tipo_sangle_id,
                'eps_id'=>$request->eps_id,
                'arl_id'=>$request->arl_id

            ]);
            ResponseController::set_messages('Se realizo el update');
            ResponseController::set_data(['persona'=>$persona]);
            return ResponseController::response('OK');
        }

        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');
    }

    public function delete (Request $request, $id){
            if($request->user()->can('add_proveedor')){
                Persona::find($id)->delete();

                ResponseController::set_messages('Registro eliminado');
                return ResponseController::response('OK');
            }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');
    }

    public function getDocumento(){

    }

    /**
     * Datos eliminado
     *  consultar
     * restaurar
    */
     public  function  showDeleteData(Request $request){
         if($request->user()->can('add_proveedor')){

         }
     }




     public  function restore(Request $request){
             if($request->user()->can('add_proveedor')){

             }

     }
}
