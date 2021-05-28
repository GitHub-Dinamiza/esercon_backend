<?php

namespace App\Http\Controllers\Proyecto;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController;
use App\Models\Proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProyectoController extends Controller
{
    /***
     * ProyectoController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /***
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request){
        if($request->user()->can('add_proyecto')){

            $proyecto = DB::transaction(function ()use ($request){
                $proyecto =Proyecto::create([

                    'codigo'=>$request->codigo,
                    'nombre'=>$request->nombre,
                    'fecha_inicio'=>$request->fecha_inicio,
                    'fecha_fin'=>$request->fecha_fin,
                    'municipio_inicio_id'=>$request->municipio_inicio,
                    'ubicacion_inicial'=>$request->ubicacion_inicial,
                    'municipio_final_id'=>$request->municipio_final,
                    'ubicacion_final'=>$request->ubicacion_final,
                    'horas_laboral_dia'=>$request->horas_laboral,
                    'temperatura'=>$request->temperatura,
                    'user_id'=>$request->user()->id
                ]);
                return $proyecto;
            });

            if(!$proyecto){
                ResponseController::set_errors(true);
                ResponseController::set_messages('Error en la creacion del proyecto');
                return ResponseController::response('BAD REQUEST');
            }

            ResponseController::set_messages('Proyecto creado');
            ResponseController::set_data(['proyecto_id'=>$proyecto->id]);
            return ResponseController::response('OK');

        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonRespons
     */
    public function show(Request $request){
        if($request->user()->can('add_proyecto')){

            ResponseController::set_data(['data'=>Proyecto::all()]);
            ResponseController::response('OK');
        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');

    }

    public function get(Request $request){
        if($request->user()->can('add_proyectos')){

        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');
    }

    public function update(Request $request){
        if($request->user()->can('add_proyectos')){

        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');
    }

    public function destroy(Request $request){
        if($request->user()->can('add_proyectos')){

        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');
    }
}
