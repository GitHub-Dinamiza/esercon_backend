<?php

namespace App\Http\Controllers\Proyecto;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController;
use App\Http\Requests\Proyecto\CreateUbicacionRequest;
use App\Models\Proyecto\AccionRecorrido;
use App\Models\Proyecto\clasificacion_ubicacion;
use App\Models\Proyecto\RecorridoProyecto;
use Illuminate\Http\Request;

class UbicacionRecorridoController extends Controller
{
    public function getAccionRecorrido(){
        $accion = AccionRecorrido::all();
        ResponseController::set_data(['accion_recorrido'=>$accion]);
        return ResponseController::response('OK');
    }

    public function getUbicacionRecorrido(){

        $ubicacionRecorrido= RecorridoProyecto::all();
        ResponseController::set_data(['ubicacion_recorrido'=>$ubicacionRecorrido]);
        return ResponseController::response('OK');
    }

    public function storeUbicacion(CreateUbicacionRequest $request){


        $ubicacio= RecorridoProyecto::create([

            'nombre'=>$request->nombre,
            'direccion'=>$request->direccion,
            'municipio_id'=>$request->municipio_id,
            'clasificacion_id'=>$request->clasificacion,
            'user_id'=>$request->user()->id
        ]);

        ResponseController::set_messages('Ubicacion Creada');
        ResponseController::set_data(['unicacion'=>$ubicacio->id]);
        return ResponseController::response('CREATED');




    }


    public function updateUbicacion(CreateUbicacionRequest $request,$id){

        $ubicacio= RecorridoProyecto::find($id);

        $ubicacio->update([

            'nombre'=>$request->nombre,
            'direccion'=>$request->direccion,
            'municipio_id'=>$request->municipio_id,
            'clasificacion_id'=>$request->clasificacion,
            'user_id'=>$request->user()->id
        ]);

        ResponseController::set_messages('Ubicacion Creada');
        ResponseController::set_data(['unicacion'=>$ubicacio]);
        return ResponseController::response('CREATED');



    }


    public function clasificacionUbicacion(Request $request){

        $clasificacionUbicacion = clasificacion_ubicacion::all();

        ResponseController::set_data(['clasificacion'=>$clasificacionUbicacion]);
        return ResponseController::response('CREATED');
    }
}
