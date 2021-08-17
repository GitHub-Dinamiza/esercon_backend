<?php

namespace App\Http\Controllers\Proveedor;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\ResponsePermisoController;
use App\Http\Requests\Proveedor\CreateProveedorRequest;
use App\Http\Resources\Proveedor\ProveedorResource;
use App\Models\DocumentoProveedor;
use App\Models\Proveedor;
use App\Models\ProveedorVehiculos;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class ProveedorController extends Controller
{
    public function  __construct(){
        $this->middleware('auth:api');
    }

    public function store(CreateProveedorRequest $request){

        if($request->user()->can('add_proveedor')) {

            $razonSicial = $request->tipo_documento == 1? 1:0;


        $provedor=    DB::transaction(function () use ($request) {
                $provedor = Proveedor::create([
                    'razon_social' => $request->razon_social,
                    'primer_nombre' => $request->primer_nombre,
                    'primer_apellido' => $request->primer_apellido,
                    'segundo_nombre' => $request->segundo_nombre,
                    'segundo_apellido' => $request->segundo_apellido,
                    'tipo_proveedor' => $request->tipo_proveedor,// Juridico o natural
                    'direccion' => $request->direccion,
                    'telefono' => $request->telefono,
                    'email' => $request->     email,
                    'municipio_id' => $request->municipio_id,
                    'user_id' => $request->user()->id // no request
                ]);
                DocumentoProveedor::create([
                    'numero' => $request->numero,
                    'tipodocumento_id' => $request->tipodocumento_id,
                    'user_id' => $request->user()->id, //no request
                    'proveedor_id' => $provedor->id //no request
                ]);

                $this->proveedorVehiculo($provedor->id,$request->municipio_proveedor_vehiculo_id);

                return $provedor;

            });

            if (!$request) {
                ResponseController::set_errors(true);
                ResponseController::set_messages('Error en la creacion del PROVEEDOR');
                return ResponseController::response('BAD REQUEST');
            }

            ResponseController::set_messages('Proveedor creado');
            ResponseController::set_data(['proveedor'=>$provedor->id]);
            return ResponseController::response('OK');
        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');

    }


    private function proveedorVehiculo($idproveedor, $ciudadProveedorVehiculo)
    {
        if($idproveedor && $ciudadProveedorVehiculo)
        {

            ProveedorVehiculos::updateOrCreate(
                ['proveedor_id'=>$idproveedor],
                [ 'municipio_id'=>$ciudadProveedorVehiculo]
            );
        }

    }

    /**
     * Creacion de numero de identificacion
     * del proveedor
     */

    public function createNumeroDocumentoProveedor(Request $request){

        if($request->user()->can('add_proveedor')) {

           $documentoProveedor = DocumentoProveedor::create([
                'numero' => $request->numero,
                'tipodocumento_id' => $request->tipodocumento_id,
                'user_id' => $request->user()->id, //no request
                'proveedor_id' => $request->provedor_id //no request
            ]);
            if (!$request) {
                ResponseController::set_errors(true);
                ResponseController::set_messages('No has enviado inforamcion para agregar numero de documento');
                return ResponseController::response('BAD REQUEST');
            }

            ResponseController::set_messages('Proveedor creado');
            ResponseController::set_data(['proveedor'=>$documentoProveedor->id]);
            return ResponseController::response('OK');
        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');

    }


    ### Update Proveedor
    public function updateProveedor(Request $request, $id){

        if($request->user()->can('add_proveedor')) {
            $provedor=    DB::transaction(function () use ($request,$id) {
                $provedor = Proveedor::find($id);

                if(!$provedor){
                    ResponseController::set_errors(true);
                    ResponseController::set_messages('No se encontro el provedor indicado');
                    return ResponseController::response('BAD REQUEST');
                }
                $provedor->update([

                    'razon_social' => $request->razon_social,
                    'primer_nombre' => $request->primer_nombre,
                    'primer_apellido' => $request->primer_apellido,
                    'segundo_nombre' => $request->segundo_nombre,
                    'segundo_apellido' => $request->segundo_apellido,
                    'tipo_proveedor' => $request->tipo_proveedor,// Juridico o natural
                    'direccion' => $request->direccion,
                    'telefono' => $request->telefono,
                    'email' => $request->     email,
                    'municipio_id' => $request->municipio_id,

                ]);

                $this->updataNumeroDocumento($request->numerodocumento);
                $this-> proveedorVehiculo( $provedor->id,$request->ciudad_proveedor_vehiculo_id);

                return $provedor;
             });
             ResponseController::set_messages('Update provedor');
             ResponseController::set_data(['proveedor'=>$provedor]);
             return ResponseController::response('OK');
        }

        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');

    }


    private function updataNumeroDocumento($request){

        if($request){
            foreach($request as $numeroDocumento){

            try{
                $documentoProveedor=DocumentoProveedor::where('numero',$numeroDocumento['numero'])->first();
                if(!$documentoProveedor){
                    ResponseController::set_messages(['Not fount'=>[
                       "numero"=>$numeroDocumento['numero']
                    ]]);
                }else{
                    $documentoProveedor->update([
                    'numero' => $numeroDocumento['numero_Actualizado'],
                    'tipodocumento_id' => $numeroDocumento['tipodocumento_id']
                    ]);

                }

            }catch(Exception $e){
                ResponseController::set_messages(['error'=>[
                    'numerodocumento'=>$numeroDocumento['numero'],
                    'msj'=>"nose pudoactulizar"
                ]]);

            }finally{

            }
         }
        }


    }

    private function updateProveedoVehiculo($ciudad_proveedor_vehiculo_id, $idproveedor){

        if($idproveedor  && $ciudad_proveedor_vehiculo_id ){
            ProveedorVehiculos::where('proveedor_id',$idproveedor)->update([

                'municipio_id'=>$ciudad_proveedor_vehiculo_id
            ]);
        }
    }
    ###
    public function getIdProveedor(Request $request, $id){

        $proveedor = Proveedor::find($id);
     }

    public function show(Request $request){
        if($request->user()->can('add_proveedor')){
            $proveedor = Proveedor::all();
            $rProveedor = ProveedorResource::collection($proveedor);

            ResponseController::set_data(['provedores'=>$rProveedor ]);
            return ResponseController::response('OK');

        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');

    }
    ##   Filtro por nick y nombre del pooverdor
    public function filtro(Request $request, $filtro){
        if($request->user()->can('add_proveedor')){

            $proveedor = Proveedor::filtro($filtro);
            ResponseController::set_data(['provedores'=>$proveedor]);
            return ResponseController::response('OK');
        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');

    }

    public function  get(Request $request){
        if($request->user()->can('add_provedor')){
            return response($request->user());
        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');
    }

    public function update(Request $request){
        if($request->user()->can('add_provedor')){
            return response($request->user());
        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');
    }

    public function  destroy(Request $request){
        if($request->user()->can('add_provedor')){
            return response($request->user());
        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');
    }

}
