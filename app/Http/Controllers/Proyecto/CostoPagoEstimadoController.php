<?php

namespace App\Http\Controllers\Proyecto;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController;
use App\Models\Proyecto\GastoEstimadoOperaciones;
use App\Models\Proyecto\GastoEstimadoProyecto;
use App\Models\ProyectoCosto;
use Illuminate\Http\Request;

class CostoPagoEstimadoController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:api');
    }


    /***
     *  Asignacion de proverdor  a la poryecto
     */

        public function  store(Request  $request){
            if($request->user()->can('add_proyecto')){
                $proyectoCosto = ProyectoCosto::create([
                    'servicio_id' =>$request->servicio_id
                    ,'proveedor_id'=>$request->proveedor_id
                    ,'proyecto_id'=>$request->proyecto_id
                    ,'forma_pago'=>$request->forma_pago
                    ,'medio_pago'=>$request->medio_pago
                    ,'otro_medio_pago'=>$request->otro_medio_pago
                    ,'pago_a_realizar'=>$request->pago_a_realizar
                ]);
                ResponseController::set_messages('Registro agregado');

                ResponseController::set_data(['Proyecto'=> $proyectoCosto]);
                return ResponseController::response('OK');
            }
        }


        public function getGastoEstimado(){

       return GastoEstimadoOperaciones::all();
    }
}
