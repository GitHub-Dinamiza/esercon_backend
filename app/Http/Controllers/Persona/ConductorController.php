<?php

namespace App\Http\Controllers\Persona;

use App\Http\Controllers\cargarArchivoController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\ValidacionEstado\ValidacionEstadoController;
use App\Http\Resources\Persona\conductorResource;
use App\Models\experiensiaLaboral;
use App\Models\Persona\ArchivosPersona;
use App\Models\Persona\Conductor;
use App\Models\Persona\Persona;
use App\Models\Provedores\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConductorController extends Controller
{
    public function  __construct(){
        $this->middleware('auth:api');
    }

    public function store(Request $request){

        if($request->user()->can('add_proveedor')) {

            $condector=    DB::transaction(function () use ($request) {

                $persona = Persona::create([
                    'primer_nombre'=>$request->primer_nombre,
                    'segundo_nombre'=>$request->segundo_nombre,
                    'primer_apellido'=>$request->primer_apellido,
                    'segundo_apellido'=>$request->segundo_apellido,
                    'tipo_documento_id'=>$request->tipo_documento_id,
                    'numero_documento'=>$request->numero_documento,
                    'ciudad_residencia_id'=>$request->ciudad_residencia_id,
                    'direccion'=>$request->direccion,
                    'telefono'=>$request->telefono,
                    'email'=>$request->email,
                    'estado_civil'=>$request->estado_civil,
                    'tipo_sangle_id'=>$request->tipo_sangle_id,
                    'eps_id'=>$request->eps_id,
                    'arl_id'=>$request->arl_id

                ]);

                Conductor::create([
                    'persona_id'=>$persona->id,
                    'proveedor_id'=>$request->proveedor_id,
                    'nombre_contacto'=>$request->nombre_contacto,
                    'telefono_contacto'=>$request->telefono_contacto,
                    'estado'=>1
                ]);
                return  $persona;
            });
            ResponseController::set_messages('conductor creado');
            ResponseController::set_data(['conductor'=>$condector]);
            return ResponseController::response('OK');

        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');
    }

    public function getall(Request $request){
        if($request->user()->can('add_proveedor')) {


            $conductor  =Conductor::all();
            $conductor = $conductor->filter(function ($item){
                //dd($item->persona->first());

                    return !empty($item->persona);


            });
            $conductor = conductorResource::collection($conductor );

            ResponseController::set_data(['Conductor'=>$conductor]);
            return ResponseController::response('OK');
        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');
    }
#Consulta de id
    public function getId (Request $request, $id){
        if($request->user()->can('add_proveedor')) {
            $conductor =Conductor::find($id);
            $conductor = $conductor->filter(function ($item){
                //dd($item->persona->first());

                return !empty($item->persona);


            });
            $conductor = conductorResource::make($conductor);

            ResponseController::set_data(['Conductor'=>$conductor]);
            return ResponseController::response('OK');
        }

        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');
    }


    public function update(Request $request, $id)
    {
        if($request->user()->can('add_proveedor')) {

            $condector=    DB::transaction(function () use ($request, $id) {
                $persona= Persona::find($id);


                $persona->update([
                    'primer_nombre'=>$request->primer_nombre,
                    'segundo_nombre'=>$request->segundo_nombre,
                    'primer_apellido'=>$request->primer_apellido,
                    'segundo_apellido'=>$request->segundo_apellido,
                    'tipo_documento_id'=>$request->tipo_documento_id,
                    'numero_documento'=>$request->numero_documento,
                    'ciudad_residencia_id'=>$request->ciudad_residencia_id,
                    'direccion'=>$request->direccion,
                    'telefono'=>$request->telefono,
                    'email'=>$request->email,
                    'estado_civil'=>$request->estado_civil,
                    'tipo_sangle_id'=>$request->tipo_sangle_id,
                    'eps_id'=>$request->eps_id,
                    'arl_id'=>$request->arl_id

                ]);
                $conductor = Conductor::where('persona_id',$persona->id);
                $conductor->update([
                    'persona_id'=>$persona->id,
                    'nombre_contacto'=>$request->nombre_contacto,
                    'telefono_contacto'=>$request->telefono_contacto,
                    'proveedor_id'=>$request->proveedor_id,
                    'nombre_contacto'=>$request->nombre_contacto,
                    'telefono_contacto'=>$request->telefono_contacto,

                ]);
                return  $persona;
            });
            ResponseController::set_messages('conductor creado');
            ResponseController::set_data(['conductor'=>$condector]);
            return ResponseController::response('OK');

        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');
    }

    public function delete(Request $request, $id){
        if($request->user()->can('add_proveedor')) {

            Persona::find($id)->delete();
            ResponseController::set_messages('Conductor eliminado correctamente');

            return ResponseController::response('OK');

        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');
    }

    public function experienciaLavoral(Request $request){
        if($request->user()->can('add_proveedor')) {

            $experienxiaLavoral = experiensiaLaboral::updateOrCreate(
                [
                    'id'=>$request->id
                ],
                [
                'empresa'=>$request->empresa,
                'fecha_inicio'=>$request->fecha_inicio,
                'fecha_fin'=>$request->fecha_fin,
                'nombre_contacto'=>$request->nombre_contacto,
                'numero_contacto'=>$request->numero_contacto,
                'persona_id'=>$request->persona_id
            ]);
            ResponseController::set_messages('');
            ResponseController::set_data(['esperiencia laborales'=>$experienxiaLavoral]);
            return ResponseController::response('OK');
        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');
    }

    public function getExperienciaLaboral(Request $request, $id ){
        if($request->user()->can('add_proveedor')) {
            $experienxiaLavoral = experiensiaLaboral::where('persona_id',$id)->get();
            ResponseController::set_data(['esperiencia laborales'=>$experienxiaLavoral]);
            return ResponseController::response('OK');
        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');

    }
    public function deleteExperienciaLavoral(Request $request, $id){

        if($request->user()->can('add_proveedor')) {
            $experienxiaLavoral = experiensiaLaboral::find($id)->delete();
            ResponseController::set_data(['esperiencia laborales'=>$experienxiaLavoral]);
            return ResponseController::response('OK');
        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');
    }

    public function cargaArchivo(Request $request, $id, $idTipoArchivo, $fecha){

        $persona = Persona::find($id);
        $conductor = Conductor::where('persona_id','$id');
        $subirAchivo =new cargarArchivoController;
        $ValidacionEstadoController = new ValidacionEstadoController;

        $path = 'conductor/documentos/';
        $dataArchivoCargado = json_decode($subirAchivo->uploadFile($request, $path));

        //dd($dataArchivoCargado->name);
        if($dataArchivoCargado->mensaje != 'Error'){
            $persona = Persona::find($id);
           $a= ArchivosPersona::create([
                'nombre'=>$dataArchivoCargado->nameFull,
                'extension'=>$dataArchivoCargado->extension,
                'ruta'=>$path,
                'fecha_espedicon'=>$fecha,
                'tamanio'=>$dataArchivoCargado->tamanio,
                'tipo_archivo_id'=>$idTipoArchivo,
                'persona_id'=>$persona->id,
                'user_id'=>$request->user()->id

            ]);
            if($a){
                $respuesta =  $ValidacionEstadoController->ActivarPorDocumentacion($persona,'tipo_archivo_conductor');
                ResponseController::set_messages(['respuesta_activacion'=>$respuesta]);
            }
        }else{
            ResponseController::set_errors(true);
            ResponseController::set_messages(['Error AL SUBIR ARCHIVO'=>$dataArchivoCargado->mensaje]);
            return ResponseController::response('BAD REQUEST');
        }
        ResponseController::set_messages('Documento agregado');
        ResponseController::set_data(['Documento_id'=>$a]);
        return ResponseController::response('OK');
    }


    public function deleteArchivo(Request $request, $id){

        if($request->user()->can('add_proveedor')) {
            ArchivosPersona::find($id)->delete();
            ResponseController::set_messages('archivo eliminado');

            return ResponseController::response('OK');
        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');
    }

    public function getArchivo(Request $request, $id){
        if($request->user()->can('add_proveedor')) {
            $archivosPersona = ArchivosPersona::where('persona_id',$id)->get();

            ResponseController::set_data(['archivos'=>$archivosPersona]);
            return ResponseController::response('OK');
        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');
    }

    public function cambiar_estado(Request $request, $id){
        if($request->user()->can('add_proveedor')) {
            $data =Persona::find($id);
            if($data->estado_id != 3){
                switch($request->estado){
                    case 'Activo':
                        $data->estado_id = 1;
                        ResponseController::set_messages('Se a activado el conductor');
                        break;
                    case 'desactivar':
                        $data->estado_id = 2;
                        ResponseController::set_messages('Se a desactivado el conductor');
                        break;
                }

                $data->save();

                ResponseController::set_data(['Conductor'=>$data]);


            } else{
                ResponseController::set_messages('No se puede activar conductor ');
            }
         return ResponseController::response('OK');
        }

        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');
    }

    public function getProveedor(Request $request, $id){
        if($request->user()->can('add_proveedor')) {
            if(!Proveedor::find($id)){
                ResponseController::set_errors(true);
                ResponseController::set_messages('Id provedor no existe');
                return ResponseController::response('UNAUTHORIZED');
            }

            $conductor = Conductor::where('proveedor_id',$id)->get();
            $conductor = $conductor->filter(function ($item){
                //dd($item->persona->first());

                return !empty($item->persona);


            });
            $conductor = conductorResource::collection($conductor);

            ResponseController::set_data(['Conductor'=>$conductor]);
            return ResponseController::response('OK');
        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');

    }


}
