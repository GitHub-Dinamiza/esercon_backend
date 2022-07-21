<?php

namespace App\Http\Controllers\Operaciones;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController;
use App\Models\Operaciones\CargaCombustibleDiario;
use Illuminate\Http\Request;

class CargaCombustibreDiarioController extends Controller
{
    public function  __construct(){
        $this->middleware('auth:api');
    }

    public function store(Request $request){
        if($request->user()->can('add_proveedor')) {

            $cargaCombustible = CargaCombustibleDiario::createData($request);
            ResponseController::set_errors($cargaCombustible['errors']);
            ResponseController::set_messages($cargaCombustible['mensaje']);
            ResponseController::set_data(['carga_cumbustibre'=>$cargaCombustible['data']]);
            return ResponseController::response($cargaCombustible['state']);
        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');
    }

    public function getAll(){

        $cargaCombustibre = CargaCombustibleDiario::allData();
        //$cargaCombustibre =CargaCombustibleDiario::all();
        ResponseController::set_errors($cargaCombustibre['errors']);
        ResponseController::set_messages($cargaCombustibre['mensaje']);
        ResponseController::set_data(['carga_cumbustibre'=>$cargaCombustibre['data']]);
        return ResponseController::response($cargaCombustibre['state']);
    }

    public function update(Request $request, $id){
        if($request->user()->can('add_proveedor')) {

            $cargaCombustible = CargaCombustibleDiario::updateData($request, $id);
            ResponseController::set_errors($cargaCombustible['errors']);
            ResponseController::set_messages($cargaCombustible['mensaje']);
            ResponseController::set_data(['carga_cumbustibre'=>$cargaCombustible['data']]);
            return ResponseController::response($cargaCombustible['state']);
        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');
    }

    public function deleteId(Request $request, $id){
        if($request->user()->can('add_proveedor')) {

            $cargaCombustible = CargaCombustibleDiario::deleteData( $id);
            ResponseController::set_errors($cargaCombustible['errors']);
            ResponseController::set_messages($cargaCombustible['mensaje']);
            ResponseController::set_data(['carga_cumbustibre'=>$cargaCombustible['data']]);
            return ResponseController::response($cargaCombustible['state']);
        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');
    }


}
