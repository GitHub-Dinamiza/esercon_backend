<?php

namespace App\Http\Controllers\Proyecto;

use App\Http\Controllers\Controller;
use App\Models\Proyecto\GastoEstimadoOperaciones;
use App\Models\Proyecto\GastoEstimadoProyecto;
use Illuminate\Http\Request;

class CostoPagoEstimadoController extends Controller
{
    //
    public function getGastoEstimado(){

       return GastoEstimadoOperaciones::all();
    }
}
