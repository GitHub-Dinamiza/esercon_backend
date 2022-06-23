<?php

namespace App\Http\Controllers\Operaciones;

use App\Http\Controllers\cargarArchivoController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController;
use App\Http\Requests\Operaciones\RevisionRequest;
use App\Http\Resources\Opreciones\revisionRequestaResource;
use App\Http\Resources\Opreciones\RevisonConsolidadoResource;
use App\Models\AsignacionRecurso\AsignacionRecurso;
use App\Models\Operaciones\DocumentoRevisionDiaria;
use App\Models\Operaciones\VehItemRevisionModel;
use App\Models\Operaciones\VehRevisionDiariaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RevisionController extends Controller
{
    public function  __construct(){
        $this->middleware('auth:api');
    }

    public function revisionDiaria(RevisionRequest $request){
        if($request->user()->can('add_proveedor')){

            //dd($request);
           // $resp = $request->map(function ($item,$key){
           //     dd($item);
           // });
            $proyecto = AsignacionRecurso::where('vehiculo_id',$request->vehiculo_id)
                ->where('state',true)->first();
            //dd($proyecto);
           // ResponseController::set_messages('');
            //ResponseController::set_data(['revision'=> $proyecto ]);
           // return ResponseController::response('OK');

            if(!empty($proyecto)) {
               // dd($proyecto->proyecto_id);

                $proyecto = DB::transaction(function () use ($request, $proyecto) {
                    //1
                    $revisionEncendido = VehRevisionDiariaModel::create([
                        'veh_item_revision_id' => 1,
                        'vehiculo_id' => $request->vehiculo_id,
                        'valor' => $request->encendido["valor"],
                        'proyecto_id'  => $proyecto->proyecto_id,
                        'responsable_id' => $request->responsable_id,
                        'comentario' => $request->encendido["comentario"],
                        'fecha_revision' => $request->fecha_revision,
                        'hora' => $request->hora,
                        'user_id' => $request->user()->id
                    ]);

                    //2
                    VehRevisionDiariaModel::create([
                        'veh_item_revision_id' => 2,
                        'vehiculo_id' => $request->vehiculo_id,
                        'valor' => $request->parabrisa_delantero["valor"],
                        'responsable_id' => $request->responsable_id,
                        'proyecto_id' => $proyecto->proyecto_id,
                        'comentario' => $request->parabrisa_delantero["comentario"],
                        'fecha_revision' => $request->fecha_revision,
                        'hora' => $request->hora,
                        'user_id' => $request->user()->id
                    ]);

                    //3


                    //4
                    VehRevisionDiariaModel::create([
                        'veh_item_revision_id' => 3,
                        'vehiculo_id' => $request->vehiculo_id,
                        'valor' => $request->parabrisa_trasero["valor"],
                        'responsable_id' => $request->responsable_id,
                        'proyecto_id' => $proyecto->proyecto_id,
                        'comentario' => $request->parabrisa_trasero["comentario"],
                        'fecha_revision' => $request->fecha_revision,
                        'hora' => $request->hora,
                        'user_id' => $request->user()->id
                    ]);

                    //5
                    VehRevisionDiariaModel::create([
                        'veh_item_revision_id' => 4,
                        'vehiculo_id' => $request->vehiculo_id,
                        'valor' => $request->retrovisor_izquiesdo["valor"],
                        'responsable_id' => $request->responsable_id,
                        'proyecto_id' => $proyecto->proyecto_id,
                        'comentario' => $request->retrovisor_izquiesdo["comentario"],
                        'fecha_revision' => $request->fecha_revision,
                        'hora' => $request->hora,
                        'user_id' => $request->user()->id
                    ]);


                    //6
                    VehRevisionDiariaModel::create([
                        'veh_item_revision_id' => 5,
                        'vehiculo_id' => $request->vehiculo_id,
                        'valor' => $request->retrovisor_derecho["valor"],
                        'responsable_id' => $request->responsable_id,
                        'proyecto_id' => $proyecto->proyecto_id,
                        'comentario' => $request->retrovisor_derecho["comentario"],
                        'fecha_revision' => $request->fecha_revision,
                        'hora' => $request->hora,
                        'user_id' => $request->user()->id
                    ]);


                    //7
                    VehRevisionDiariaModel::create([
                        'veh_item_revision_id' => 6,
                        'vehiculo_id' => $request->vehiculo_id,
                        'valor' => $request->Vidrio_puerta_Derecha["valor"],
                        'responsable_id' => $request->responsable_id,
                        'proyecto_id' => $proyecto->proyecto_id,
                        'comentario' => $request->Vidrio_puerta_Derecha["comentario"],
                        'fecha_revision' => $request->fecha_revision,
                        'hora' => $request->hora,
                        'user_id' => $request->user()->id
                    ]);


                    //8
                    VehRevisionDiariaModel::create([
                        'veh_item_revision_id' => 7,
                        'vehiculo_id' => $request->vehiculo_id,
                        'valor' => $request->Vidrio_Puerta_Izquierdo["valor"],
                        'responsable_id' => $request->responsable_id,
                        'proyecto_id' => $proyecto->proyecto_id,
                        'comentario' => $request->Vidrio_Puerta_Izquierdo["comentario"],
                        'fecha_revision' => $request->fecha_revision,
                        'hora' => $request->hora,
                        'user_id' => $request->user()->id
                    ]);


                    //9


                    //10
                    VehRevisionDiariaModel::create([
                        'veh_item_revision_id' => 10,
                        'vehiculo_id' => $request->vehiculo_id,
                        'valor' => $request->Corneta["valor"],
                        'responsable_id' => $request->responsable_id,
                        'proyecto_id' => $proyecto->proyecto_id,
                        'comentario' => $request->Corneta["comentario"],
                        'fecha_revision' => $request->fecha_revision,
                        'hora' => $request->hora,
                        'user_id' => $request->user()->id
                    ]);


                    //11
                    VehRevisionDiariaModel::create([
                        'veh_item_revision_id' => 11,
                        'vehiculo_id' => $request->vehiculo_id,
                        'valor' => $request->Aire_Acondicionado["valor"],
                        'responsable_id' => $request->responsable_id,
                        'proyecto_id' => $proyecto->proyecto_id,
                        'comentario' => $request->Aire_Acondicionado["comentario"],
                        'fecha_revision' => $request->fecha_revision,
                        'hora' => $request->hora,
                        'user_id' => $request->user()->id
                    ]);


                    //13
                    VehRevisionDiariaModel::create([
                        'veh_item_revision_id' => 12,
                        'vehiculo_id' => $request->vehiculo_id,
                        'valor' => $request->Aceite["valor"],
                        'responsable_id' => $request->responsable_id,
                        'proyecto_id' => $proyecto->proyecto_id,
                        'comentario' => $request->Aceite["comentario"],
                        'fecha_revision' => $request->fecha_revision,
                        'hora' => $request->hora,
                        'user_id' => $request->user()->id
                    ]);

                    //12
                    VehRevisionDiariaModel::create([
                        'veh_item_revision_id' => 13,
                        'vehiculo_id' => $request->vehiculo_id,
                        'valor' => $request->Refrigerante["valor"],
                        'responsable_id' => $request->responsable_id,
                        'proyecto_id' => $proyecto->proyecto_id,
                        'comentario' => $request->Refrigerante["comentario"],
                        'fecha_revision' => $request->fecha_revision,
                        'hora' => $request->hora,
                        'user_id' => $request->user()->id
                    ]);

                    VehRevisionDiariaModel::create([
                        'veh_item_revision_id' => 14,
                        'vehiculo_id' => $request->vehiculo_id,
                        'valor' => $request->Sistemas_Hidraulico["valor"],
                        'responsable_id' => $request->responsable_id,
                        'proyecto_id' =>$proyecto->proyecto_id,
                        'comentario' => $request->Sistemas_Hidraulico["comentario"],
                        'fecha_revision' => $request->fecha_revision,
                        'hora' => $request->hora,
                        'user_id' => $request->user()->id
                    ]);
                    VehRevisionDiariaModel::create([
                        'veh_item_revision_id' => 8,
                        'vehiculo_id' => $request->vehiculo_id,
                        'valor' => 'falso',
                        'responsable_id' => $request->responsable_id,
                        'proyecto_id' => $proyecto->proyecto_id,
                        'comentario' => $request->Sistemas_Hidraulico["comentario"],
                        'fecha_revision' => $request->fecha_revision,
                        'hora' => $request->hora,
                        'user_id' => $request->user()->id
                    ]);


                });
            }else{
                ResponseController::set_errors(true);
                ResponseController::set_messages('vehiculo no asociado a proyecto');
                return ResponseController::response('UNAUTHORIZED');
            }
            $revision  = VehRevisionDiariaModel::where('vehiculo_id',$request->vehiculo_id)
                ->where('fecha_revision',$request->fecha_revision)->get();
            $revision = $revision->filter(function ($value,$key){
                return $value['valor']== 'falso';
            })->
            mapWithKeys(function ($item,$key){
                $name = VehItemRevisionModel::find($item['veh_item_revision_id']);
                return  [$name->nombre=>$item['id']];
            });
            ResponseController::set_messages('');
            ResponseController::set_data(['revision'=> $revision ]);
            return ResponseController::response('OK');


        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');

    }
    public function gett(Request $request){
        if($request->user()->can('add_proveedor')){
            $revision  = VehRevisionDiariaModel::where('vehiculo_id',2)
                ->where('fecha_revision',"2022-06-27")->get();
            $revision = $revision->filter(function ($value,$key){
                return $value['valor']== 'falso';
            })->
            mapWithKeys(function ($item,$key){
                $name = VehItemRevisionModel::find($item['veh_item_revision_id']);
                return  [$name->nombre=>$item['id']];
            });
            ResponseController::set_messages('');
            ResponseController::set_data(['revision'=> $revision->all() ]);
            return ResponseController::response('OK');

        }
    }

    public function gett2(Request $request){
        if($request->user()->can('add_proveedor')){
            $revision2  = VehRevisionDiariaModel::all();
            $revision2=$revision2->groupBy('fecha_revision', function ($item, $key){
                return $item;
            });

            $revision = DB::table('veh_revision_daria')
                ->select('fecha_revision','responsable_id','proyecto_id', 'vehiculo_id','hora')
                ->groupBy('fecha_revision','responsable_id','proyecto_id', 'vehiculo_id','hora')
                ->get();
            $revision = RevisonConsolidadoResource::Collection($revision);

            ResponseController::set_messages('');
            ResponseController::set_data(['revision'=> $revision]);
            return ResponseController::response('OK');

        }
    }

    public function gettid(Request $request,$id,$fecha){
        if($request->user()->can('add_proveedor')){
            $revision2  = VehRevisionDiariaModel::where('vehiculo_id',$id)
                ->where('fecha_revision',$fecha)->get();
            $revision2=  revisionRequestaResource::collection($revision2);

            $revision = DB::table('veh_revision_daria')
                ->select('fecha_revision', 'responsable_id','vehiculo_id','hora')
                ->groupBy('fecha_revision','responsable_id', 'vehiculo_id','hora')
                ->get();


            ResponseController::set_messages('');
            ResponseController::set_data(['revision'=> $revision2]);
            return ResponseController::response('OK');

        }
    }

    public function delete(Request $request,$id,$fecha){
        if($request->user()->can('add_proveedor')){
            $revision2  = VehRevisionDiariaModel::where('vehiculo_id',$id,$fecha);
            $revision2->delete();

            ResponseController::set_messages('se elimino la revision');

            return ResponseController::response('OK');
        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');
    }

    public function cargaArchivo(Request  $request, $id ){
        $subirArchivo = new cargarArchivoController;

        $path = 'Revision/';
        $dataArchivoCargado = json_decode($subirArchivo->uploadFile($request, $path));
        if($dataArchivoCargado->mensaje != 'Error'){

            $archivo = DocumentoRevisionDiaria::create([
                'veh_revision_daria_id'=>$id
                ,'nombre'=>$dataArchivoCargado->nameFull
                ,'extension'=>$dataArchivoCargado->extension
                ,'ruta'=>$path
                ,'user_id'=>$request->user()->id
            ]);
        }else{
            ResponseController::set_errors(true);
            ResponseController::set_messages(['Error AL SUBIR ARCHIVO'=>$dataArchivoCargado->mensaje]);
            return ResponseController::response('BAD REQUEST');
        }
        ResponseController::set_messages('Documento agregado');
        ResponseController::set_data(['Documento_id'=>$archivo]);
        return ResponseController::response('OK');
    }




}
