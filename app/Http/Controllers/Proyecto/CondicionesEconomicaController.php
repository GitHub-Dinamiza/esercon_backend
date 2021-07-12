<?php

namespace App\Http\Controllers\Proyecto;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proyecto\NombreCondicionesEconomica;
use App\Http\Controllers\ResponseController;

class CondicionesEconomicaController extends Controller
{
    //

    public function addNombre (Request $request){
        $d = NombreCondicionesEconomica::create([
            'nombre'=>$request->nombre
        ]);
    }

    public function showNombre(Request $request)
    {
        $nombreConEcono = NombreCondicionesEconomica::all();


        ResponseController::set_data(['proyecto_id'=>$nombreConEcono]);
        return ResponseController::response('OK');
    }
}
