<?php

namespace App\Http\Controllers\Proyecto;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController;
use App\Models\Servicio;
use App\Models\TipoCostoServicio;
use Illuminate\Http\Request;

class ServiciosController extends Controller
{
    public function store(Request $request){
        $servicio = Servicio::create([
            'nombre'=>$request->nombre
        ]);
        ResponseController::set_messages('servicio creado');
        ResponseController::set_data(['servicio_id'=>$servicio->id]);
        return ResponseController::response('OK');
    }

    public function filtre( $nombre){
        $servicio = Servicio::nombres($nombre);

        ResponseController::set_data(['servicios'=>$servicio,'nombre'=>$nombre]);
        return ResponseController::response('OK');
    }

    public function show(){
        $servicio = Servicio::all();

        ResponseController::set_data(['servicios'=>$servicio]);
        return ResponseController::response('OK');
    }

    public function addDetalleCosto($servicio_id, Request $request){
        $detalleCosto = TipoCostoServicio::create([
            'servicio_id'=>$servicio_id,
            'nombre'=>$request->nombre
        ]);
        ResponseController::set_data(['detalleCostos'=>$detalleCosto]);
        ResponseController::set_messages('Detalle del costo agregado');
        return ResponseController::response('OK');
    }
    public function showDetallecosto($servicio_id){
        $detalleCosto = TipoCostoServicio::find($servicio_id);
        ResponseController::set_data(['detalleCostos'=>$detalleCosto]);
        return ResponseController::response('OK');
    }
}
