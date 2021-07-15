<?php

namespace App\Http\Controllers\Proyecto;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController;
use App\Models\Proyecto\AccionRecorrido;
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
}
