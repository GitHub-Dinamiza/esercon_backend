<?php

namespace App\Http\Controllers;

use App\Models\GeneralData;
use Illuminate\Http\Request;

class DatogeneralController extends Controller
{

    public function  __construct(){
        $this->middleware('auth:api');
    }

    public function getdato(Request $request, $data){
        if($request->user()->can('add_proveedor')) {

        $data = GeneralData::where('table_iden',$data)->get();

        ResponseController::set_data(['dato_genera'=>$data]);
        return ResponseController::response('OK');

        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');
    }
}
