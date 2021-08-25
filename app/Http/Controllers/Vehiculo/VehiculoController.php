<?php

namespace App\Http\Controllers\Vehiculo;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController;
use App\Http\Resources\modeloVehiculoResource;
use App\Http\Resources\VehiculoResource;
use App\Models\CarecteristicaVehiculo;
use App\Models\GeneralData;
use App\Models\Vehiculo\TipoVehiculo;
use App\Models\Vehiculos;

use Illuminate\Http\Request;


class VehiculoController extends Controller
{
    public function  __construct(){
        $this->middleware('auth:api');
    }


    public function addTipoVehiculo(Request $request){

        if($request->user()->can('add_proveedor')){

            $tipoVehiculo = TipoVehiculo::updateOrCreate(
                [   'id'=>$request->id

                ],
                [
                    'marca_id'=>$request->marca_id,
                    'modelo'=>$request->modelo,
                    'anio_fabricacion'=>$request->año_fabricacion
                ]
            );
            if(!$tipoVehiculo){
                ResponseController::set_errors(true);
                ResponseController::set_messages('error a crear el tipo vehiculo');
                return ResponseController::response('BAD REQUEST');
            }
            ResponseController::set_messages('Vehiculo agregado');
            ResponseController::set_data(['vehiculo'=>$tipoVehiculo]);
            return ResponseController::response('OK');
        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');
    }

    public function getTipoVehiculo(Request $request){
        $tipoVehiculo = TipoVehiculo::all();
        $tipoVehiculo = modeloVehiculoResource::collection($tipoVehiculo) ;
        ResponseController::set_data(['tipo_vehiculo'=>$tipoVehiculo]);
        return ResponseController::response('OK');
    }

    public function addVehiculo(Request $request){
        if($request->user()->can('add_proveedor')) {

            $vehiculo =Vehiculos::updateOrCreate(
                [ 'id'=>$request->id],
                [
                    'placa'=>$request->placa,
                    'tipo_vehiculo_id'=>$request->tipo_vehiculo_id,

                    'capacidad_volco_m3'=>$request->capacidad_volco_m3,
                    'proveedor_id'=>$request->provedor_id,
                    'propietario'=>$request->propetario,
                    'tiene_zorro'=>$request->zorro,
                    'capacidad_zorro'=>$request->capacidad_zorro_m3

                ]
            );

            if(!$vehiculo){
                ResponseController::set_errors(true);
                ResponseController::set_messages('error a crear el vehiculo');
                return ResponseController::response('BAD REQUEST');
            }

            ResponseController::set_messages('Vehiculo agregado');
            ResponseController::set_data(['vehiculo'=>$vehiculo]);
            return ResponseController::response('OK');

        }

        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');

    }

    public function getVehiculo(Request $request){

        if($request->user()->can('add_proveedor')) {

            $vehiculo =Vehiculos::all();
            $vehiculo = VehiculoResource::collection($vehiculo);
            ResponseController::set_data(['vehiculo'=>$vehiculo]);
            return ResponseController::response('OK');
        }

        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');

    }


    ### MARCA
    public function addMarca(Request $request){

        if($request->user()->can('add_proveedor')) {

            $marca = GeneralData::updateOrCreate(
                [
                    'id'=>$request->id,

                ],
                [
                    'name'=>$request->nombre,
                    'table_iden'=>'Marca_vehiculos',
                    'slug'=>$request->detalle
                ]
             );
             ResponseController::set_messages('Marca der vehiculo  agregado  o actualizada correctamente');
             ResponseController::set_data(['marca'=>$marca]);
             return ResponseController::response('OK');

        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');
    }


    public function getMarca(Request $request){

        if($request->user()->can('add_proveedor')) {
            $marca = GeneralData::all();

            ResponseController::set_data(['marca'=>$marca]);
             return ResponseController::response('OK');
        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');

    }


    ### CarateristicaVehiculo

    public function addCarateristicaVehiculo(Request $request ){

        if($request->user()->can('add_proveedor')) {


            $carateristicaVehiculo = CarecteristicaVehiculo::updateOrCreate(
                ['id'=>$request->id],
                [
                    'nombre'=>$request->nombre,
                    'tipo_dato'=>$request->tipo_dato
                ]
            );
            ResponseController::set_messages('el dato vehiculo ha sido agregado  o actualizada correctamente');

            ResponseController::set_data(['dato_vehiculo'=>$carateristicaVehiculo]);
            return ResponseController::response('OK');
        }

        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');
    }


    public function getCarateristicaVehiculo(Request $request ){

        if($request->user()->can('add_proveedor')) {

            $carateristicaVehiculo = CarecteristicaVehiculo::all();

            ResponseController::set_data(['dato_vehiculo'=>$carateristicaVehiculo]);
            return ResponseController::response('OK');

        }


        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');
    }

    public function deleleteVehiculo(Request $request, $id){


        $vehiculo = Vehiculos::find($id);
        $vehiculo->delete;

        ResponseController::set_messages('Vehicul;o eliminado');
        return ResponseController::response('OK');
    }
}
