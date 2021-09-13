<?php

namespace App\Http\Controllers\Vehiculo;

use App\Http\Controllers\cargarArchivoController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController;
use App\Http\Resources\CaracteristicaVehiculosResource;
use App\Http\Resources\modeloVehiculoResource;
use App\Http\Resources\VehiculoResource;
use App\Models\CaracteristicasAsignadaVehiculo;
use App\Models\CarecteristicaVehiculo;
use App\Models\GeneralData;
use App\Models\Vehiculo\ArchivoVehiculo;
use App\Models\Vehiculo\TipoVehiculo;
use App\Models\Vehiculos;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
###
    public function getVehiculo(Request $request){

        if($request->user()->can('add_proveedor')) {

            $vehiculo =Vehiculos::all();
           // $vehiculo->asignacionCarateristica();
            $vehiculo = VehiculoResource::collection($vehiculo);
            ResponseController::set_data(['vehiculo'=>$vehiculo]);
            return ResponseController::response('OK');
        }

        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');

    }
##

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

### Caracteristicas de vehiculos
    public function getCarateristicaVehiculo(Request $request ){

        if($request->user()->can('add_proveedor')) {

            $carateristicaVehiculo = CarecteristicaVehiculo::all();
            //$carateristicaVehiculo = CaracteristicaVehiculosResource::collection($carateristicaVehiculo);
            $data = CaracteristicaVehiculosResource::collection($carateristicaVehiculo);
            $data1 =new Collection();
            //$data1 = $data->first();
            foreach ($data as $d){

                $data1 = $data1->union($d);
            }
              $data1 =$data1->union(['vehiculoid'=>'integer']);
            ResponseController::set_data(['dato_vehiculo'=>$data1]);
            return ResponseController::response('OK');

        }


        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');
    }

### Asignacion de caracteristicas a vehiculos
    public function asignacionCaracteristicaVehiculoe(Request $request){

        if($request->user()->can('add_proveedor')) {

            $d = DB::transaction(function () use($request) {
                foreach($request->caracteristica as $index=> $data){

                        $idcaracteristica = CarecteristicaVehiculo::where('nombre',$index)->first();
                        // dd($request->vehiculoid);
                        $caracteristica =CaracteristicasAsignadaVehiculo::create([
                            'vehiculo_id'=>$request->vehiculoid,
                            'caracteristica_vehiculo_id'=> $idcaracteristica->id,
                            'estado'=>$data,
                            'detalle'=>"prueba"
                        ]);

                }
                return $caracteristica;
            });

            ResponseController::set_messages('asignacion de caracteristicas correcto');
          //  ResponseController::set_data(['caracteristicaAsignada'=> $caracteristica]);
            return ResponseController::response('OK');
        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');
    }

    //update
    public function updateAsignacionCaracteristicaVehiculo(Request $request, $id){

        if($request->user()->can('add_proveedor')) {
            foreach($request->caracteristica as $index=> $data){

                $idcaracteristica =CarecteristicaVehiculo::where('nombre',$index)->first();
                $idd =$idcaracteristica["id"];
                $caracteristica = CaracteristicasAsignadaVehiculo::where('vehiculo_id',$id)
                                ->where('caracteristica_vehiculo_id',$idd)
                                ->update([
                                        'estado'=>$data
                                         ]);

            }

            $d =CaracteristicasAsignadaVehiculo::where('vehiculo_id',$id)->get();

           ResponseController::set_messages('asignacion de caracteristicas correcto');
          ResponseController::set_data(['caracteristicaAsignada'=>$d]);
         return ResponseController::response('OK');
        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');

    }

    public function asignarCaracteristicaIndividual(Request $request ){

        if($request->user()->can('add_proveedor')) {

            $idcaracteristica =CarecteristicaVehiculo::where('nombre',$request->name_date)->first();
            CaracteristicasAsignadaVehiculo::updateOrCreate([
                'vehiculo_id'=>$request->vehiculo_id,
                'caracteristica_vehiculo_id'=>$idcaracteristica->id
            ],
            [
                'estado'=>$request->dato,
                'detalle'=>'prueba'

            ]);

           ResponseController::set_messages('asignacion de caracteristicas correcto');
           //ResponseController::set_data(['caracteristicaAsignada'=>$d]);
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


    ### Asigncacion de vehiculo
    public function addAsignacionVehiculo(Request $request){

        foreach($request as $index=>$dato){
             $AsignacionVehiculo = CaracteristicasAsignadaVehiculo::create([
                'vehiculo_id'=>$request->id_Vehiculo,
                'caracteristica_vehiculo_id'=>$request->caracteristica_vehiculo_id,
                'estado'=>$request->dato
            ]);
        }



    }

    public function cargarArchivo(Request $request, $id, $idTipoArchivo, $fechae){
        $proveedor= Vehiculos::find($id);
        $subirAchivo =new cargarArchivoController;

        $path = 'veliculo/documentos/';
        $dataArchivoCargado = json_decode($subirAchivo->uploadFile($request, $path));

        //dd($dataArchivoCargado->name);
        if($dataArchivoCargado->mensaje != 'Error'){

           $a= ArchivoVehiculo::create([
                'nombre'=>$dataArchivoCargado->nameFull,
                'extension'=>$dataArchivoCargado->extension,
                'ruta'=>$path,
                'tamanio'=>$dataArchivoCargado->tamanio,
                'tipo_archivo_id'=>$idTipoArchivo,
                'vehiculo_id'=>$proveedor->id,
                'fecha_espedicon'=>$fechae,
                'user_id'=>$request->user()->id

            ]);
        }else{
            ResponseController::set_errors(true);
            ResponseController::set_messages(['Error AL SUBIR ARCHIVO'=>$dataArchivoCargado->mensaje]);
            return ResponseController::response('BAD REQUEST');
        }
        ResponseController::set_messages('Documento agregado');
        ResponseController::set_data(['Documento_id'=>$a]);
        return ResponseController::response('OK');
    }

    public function getArchivo(Request $request, $id){

        if($request->user()->can('add_proveedor')) {
            $a= ArchivoVehiculo::where('vehiculo_id',$id)->get();

            ResponseController::set_messages('Documento agregado');
            ResponseController::set_data(['Documento_id'=>$a]);
            return ResponseController::response('OK');
        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');
    }
}
