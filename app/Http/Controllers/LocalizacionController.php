<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Models\Municipio;
use Illuminate\Http\Request;

class LocalizacionController extends Controller
{
    public function show(){
        ResponseController::set_data(['despartamentos'=>Departamento::all()]);
        return ResponseController::response('OK');
    }

    public function get($id){
        ResponseController::set_data(['despartamento'=>Departamento::find($id)]);
        return ResponseController::response('OK');
    }

    public function showMunicipios($id){
        $departamento =Departamento::find($id);
        $departamento->municipios;
        ResponseController::set_data(['despartamento'=>$departamento]);
        return ResponseController::response('OK');
    }

    public function getMunicipio($id){
        ResponseController::set_data(['municipio'=>Municipio::find($id)]);
        return ResponseController::response('OK');
    }
}
