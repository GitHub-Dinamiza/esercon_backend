<?php

namespace App\Http\Controllers\Rutas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;


class RutasController extends Controller
{
    public function  show(){
       $a = Artisan::command('route:list --json');

       return response()->json(['rutas'=>$a]);
    }
}
