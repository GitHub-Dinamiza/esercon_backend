<?php

namespace App\Http\Controllers\Proyecto;

use App\Http\Controllers\cargarArchivoController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController;
use App\Models\ArchivoProyecto;
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
        if($request->user()->can('show_proyecto')){

            ResponseController::set_data(['data'=>Proyecto::all()]);
            return ResponseController::response('OK');
        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');

    }




    public function get(Request $request,$id){
        if($request->user()->can('show_proyecto')){
            $proyecto =Proyecto::find($id);
            $proyecto->archivos;
            ResponseController::set_data(['data'=>$proyecto]);
            return ResponseController::response('OK');
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

    public function destroy(Request $request,$id){
        if($request->user()->can('delete_proyecto')){
            Proyecto::finf($id)->delete();
        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');
    }

    public function cargarArchivo(Request $request, $id){
        $proyecto= Proyecto::find($id);
        $subirAchivo =new cargarArchivoController;

        $path = 'Proyectos/'.$proyecto->nombre.'/';
        $dataArchivoCargado = json_decode($subirAchivo->uploadFile($request, $path));

        //dd($dataArchivoCargado->name);
        if($dataArchivoCargado->mensaje != 'Error'){

           $a= ArchivoProyecto::create([
                'nombre'=>$dataArchivoCargado->nameFull,
                'extension'=>$dataArchivoCargado->extension,
                'ruta'=>$path,
                'proceso_id'=>1,
                'proyecto_id'=>$proyecto->id,
                'user_id'=>$request->user()->id

            ]);
        }else{
            ResponseController::set_errors(true);
            ResponseController::set_messages('Error AL SUBIR ARCHIVO');
            return ResponseController::response('BAD REQUEST');
        }
        ResponseController::set_messages('Documento agregado');
        ResponseController::set_data(['Documento_id'=>$a->id]);
        return ResponseController::response('OK');
    }

    public function borrarAchivo(Request $request,$id){
        $archivo =ArchivoProyecto::find($request->documento_id);
        if(
            $archivo->delete()
        ){
            ResponseController::set_messages('Archivo eliminado');

            return ResponseController::response('OK');
        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Error al eliminar el documento');
        return ResponseController::response('BAD REQUEST');

    }


}
