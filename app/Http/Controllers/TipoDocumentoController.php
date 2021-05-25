<?php

namespace App\Http\Controllers;

use App\Models\TipoDocumento;
use Illuminate\Http\Request;

class TipoDocumentoController extends Controller
{
    public function show(){
        ResponseController::set_data(['tipos_documentos'=>TipoDocumento::all()]);
        return ResponseController::response('OK');
    }

    public function get($id){
        ResponseController::set_data(['tipo_documento'=>TipoDocumento::find($id)]);
        return ResponseController::response('OK');

    }
}
