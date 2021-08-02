<?php

namespace App\Http\Controllers\Proyecto;

use App\Http\Controllers\cargarArchivoController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController;
use App\Http\Requests\Proyecto\CreateProyectoRequest;
use App\Http\Resources\proyectoAllResource;
use App\Models\ArchivoProyecto;
use App\Models\costoServicioDetalle;
use App\Models\Proyecto;
use App\Models\ProyectoCosto;
use App\Models\Servicio;
use App\Models\TipoCostoServicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Resources\Proyecto as ResourceProyecto;
use App\Models\Proyecto\CondicionesEconomica;
use App\Models\Proyecto\GastoEstimadoOperaciones;
use App\Models\Proyecto\GastoEstimadoProyecto;
use App\Models\Proyecto\NombreCondicionesEconomica;
use App\Models\Proyecto\RecorridoUbicacionProyecto;
use Exception;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use InvalidArgumentException;
use Validator;

class ProyectoController extends Controller
{
    /***
     * ProyectoController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function validadorProyecto(Request $request){

        $proyecto = Proyecto::where('codigo',$request->codigo)->get();

        if(count($proyecto)> 0){

            ResponseController::set_messages('existe un proyecto registrado con el codigo ingresado ');

            return ResponseController::response('BAD REQUEST');
        }

        ResponseController::set_messages('El codigo no esta registrado ');
        return ResponseController::response('OK');
    }

    /***
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateProyectoRequest $request){
       // $validator = ValidationValidator::make($request->all());

        if($request->user()->can('add_proyecto')){
            $proyecto = DB::transaction(function ()use ($request){

                ### Creacion de proyecto
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
                    'propietario_dobletroque'=>$request->propietario_dobletroque,
                    'duracion_dias'=>$request->duracion_proyecto,
                    'cantidad_vehiculo_propio'=>$request->cantidad_vehiculo_propio,
                    'cantidad_vehiculo_alquilado'=>$request->cantidad_vehiculo_alquilado,
                    'valor_metrocubico_propio'=>$request->valor_metrocubico_propio,
                    'valor_metrocubico_alquilado'=>$request->valor_metrocubico_alquilado,
                    'valor_contrato'=>$request->valor_contrato,
                    'valor_anticipo_contrato'=>$request->valor_anticipo_contrato,
                    'antiguedad_vehiculos_anios'=>$request->antiguedad_vehiculo,
                    'otro_requerimientos'=>$request->otros_requerimientos,
                    'user_id'=>$request->user()->id
                    /**
                     *  Nuevos Campos (codiciones ingreso)
                     */
                ]);

                if($request->tiposVias != []){
                    foreach ($request->tiposVias as $index => $req) {
                        $proyecto->tipoVia()->attach($req["tipovia_id"],
                            $req["tipovia_id"]==4?['otros'=>$req["otros"]]:[]);
                    }
                }
                if($request->rellenos != []){
                    foreach ($request->rellenos as $index => $req){
                        $proyecto->tipoMaterial()->attach($req["tipo_material_id"]
                            , $req["tipo_material_id"]==4?['otros'=>$req["otros"]]:[]);
                    }
                }

                ### se recorres  el reequest  para  crear para la  crecion de costo servicio
                foreach ($request->costoServicio as $index => $req){

                    ## Encaso de que servicio id sea otros se creara un servicio nuevo
                    if($req !=[]){

                        $serv = $req["servicio_id"];

                        if($req["servicio_id"]==4){
                            $serv = Servicio::create([
                                'nombre'=>$req["otro_servicio"]
                            ]);
                            $serv = $serv->id;
                        }

                        ## Creacion de costo Servicio
                        $costoServicio = ProyectoCosto::create([

                                'servicio_id'=>$serv,
                                'proveedor_id'=>$req["proveedor_id"],
                                'proyecto_id'=>$proyecto->id,
                                'forma_pago'=>$req["forma_pago"],
                                'medio_pago'=>$req["medio_pago"],
                                'otro_medio_pago'=>$req["medio_pago"]=='Otros'?$req["otro_medio_pago"]:"" ,
                                'pago_a_realizar'=>$req["pago_a_realizar"]
                            ]);

                        ## se cargan los el detalle de los servicios
                        foreach($req["detalle"] as $index => $costo){

                            if($costo != []){
                                $ti = $costo['tipo_costo_servicio_id'];

                                if($costo["tipo_costo_servicio_id"]== 4){
                                    $ti = TipoCostoServicio::create([

                                        'servicio_id'=>$serv,
                                        'nombre'=>$costo["otro_costo_servicio"]

                                        ]);
                                    $ti =$ti->id;
                                }

                                $costo = costoServicioDetalle::create([

                                    'proyecto_costo_servico_id'=>$costoServicio->id,
                                    'tipo_costo_servicio_id'=>$ti,
                                    'valor'=>$costo["valor"]

                                ]);
                            }
                        }

                    }


                }

                 ### Condiciones Economica
                 foreach($request->condiciones_economicas as $index =>$req){
                    $nce=$req["nombre_condicion_economica_id"];
                    if($nce==4){
                        $nce= NombreCondicionesEconomica::create([
                            'nombre'=>$req["otro_condicion_economica"]
                        ]);

                        $nce=$nce->id;

                    }

                    $ce = CondicionesEconomica::create([

                        'nombre_condicion_economica_id'=>$nce,
                        'proyecto_id'=>$proyecto->id,
                        'forma_pago'=>$req["forma_pago"],
                        'medio_pago'=>$req["medio_pago"],
                        'pago_a_realizar'=>$req["pago_a_realizar"]

                    ]);


                 }

                ### Costo Estimado pago Operaciones
                 foreach($request->datos_operacion as $index=> $req){

                    $gastoEO = GastoEstimadoOperaciones::where('nombre' ,$index)->first();

                    GastoEstimadoProyecto::create([
                        'gasto_estimado_operaciones_id'=>$gastoEO->id,
                        'proyecto_id'=>$proyecto->id,
                        'valor'=>$req,
                        'user_id'=>$request->user()->id
                    ]);


                }

                foreach($request->datos_administracion as $index=> $req){

                    $gastoEO = GastoEstimadoOperaciones::where('nombre' ,$index)->first();

                    GastoEstimadoProyecto::create([
                        'gasto_estimado_operaciones_id'=>$gastoEO->id,
                        'proyecto_id'=>$proyecto->id,
                        'valor'=>$req,
                        'user_id'=>$request->user()->id
                    ]);
                }

                  ### recorrido

                foreach ($request->recorridos as $index => $req){

                    RecorridoUbicacionProyecto::create([
                        'proyecto_id'=>$proyecto->id,
                        'recorrido_inicio_id'=>$req["recorrido_inicio_id"],
                        'recorrido_final_id'=>$req["recorrido_final_id"],
                        'accion_id'=>$req["accion_id"],
                        'user_id'=>$request->user()->id
                    ]);
                }

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

            ResponseController::set_data(['Proyecto'=>proyectoAllResource::collection(Proyecto::all()) ]);
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
            $proyecto->municipio;
            $proyecto =ResourceProyecto::make($proyecto);
            ResponseController::set_data(['proyecto'=>$proyecto]);
            return ResponseController::response('OK');
        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');
    }

 ### ACtualizar
    public function update1(Request $request, $id){
        if($request->user()->can('update_proyecto')){


                $proyecto = DB::transaction(function ()use ($request, $id){

                    //DATA REQUEST
                    $codigo = $request->codigo;
                    $nombre = $request->nombre;
                    $fecha_inicio = $request->fecha_inicio;
                    $fecha_fin = $request->fecha_fin;
                    $municipio_inicio = $request->municipio_inicio;
                    $ubicacion_inicial = $request->ubicacion_inicial;
                    $municipio_final = $request->municipio_final;
                    $ubicacion_final = $request->ubicacion_final;
                    $horas_laboral = $request->horas_laboral;
                    $temperatura = $request->temperatura;
                    $propietario_dobletroque = $request->propietario_dobletroque;
                    $duracion_proyecto = $request->duracion_proyecto;
                    $cantidad_vehiculo_propio = $request->cantidad_vehiculo_propio;
                    $cantidad_vehiculo_alquilado = $request->cantidad_vehiculo_alquilado;
                    $valor_metrocubico_propio = $request->valor_metrocubico_propio;
                    $valor_metrocubico_alquilado = $request->valor_metrocubico_alquilado;
                    $valor_contrato = $request->valor_contrato;
                    $valor_anticipo_contrato = $request->valor_anticipo_contrato;
                    $antiguedad_vehiculo = $request->antiguedad_vehiculo;
                    $otros_requerimientos = $request->otros_requerimientos;

                    $tipoVias = $request->tipo_vias;
                    $relleno = $request->rellenos;

                    $proyecto = Proyecto::find($id);
                    $bandera = false;
                        if($proyecto != null){

                            if($codigo != null || $codigo != ''){

                                $proyecto->codigo=$request->codigo;
                                $bandera = true;
                            }

                            if($nombre != null || $nombre != ''){
                                $proyecto->nombre=$request->nombre;
                                $bandera = true;
                            }

                            if($fecha_inicio != null || $fecha_inicio != ''){
                                $proyecto->fecha_inicio=$request->fecha_inicio;
                                $bandera = true;
                            }

                            if($fecha_fin != null  || $fecha_fin != ''){
                                $proyecto->fecha_fin=$request->fecha_fin;
                                $bandera = true;
                            }

                            if($municipio_inicio != null || $municipio_inicio !=''){
                                $proyecto->municipio_inicio_id=$request->municipio_inicio;
                                $bandera = true;
                            }

                            if($ubicacion_inicial != null || $ubicacion_inicial !=''){
                                $proyecto->ubicacion_inicial=$request->ubicacion_inicial;
                                $bandera = true;
                            }


                            if($municipio_final != null || $municipio_final != ''){
                                $proyecto->municipio_final_id=$request->municipio_final;
                                $bandera = true;
                            }

                            if($ubicacion_final != null || $ubicacion_final != ''){
                                $proyecto->ubicacion_final=$request->ubicacion_final;
                                $bandera = true;
                            }

                            if($horas_laboral != null || $horas_laboral){
                                $proyecto->horas_laboral_dia=$request->horas_laboral;
                                $bandera = true;
                            }

                            if($temperatura != null || $temperatura != ''){
                                $proyecto->temperatura=$request->temperatura;
                                $bandera = true;
                            }

                            if($propietario_dobletroque != null || $propietario_dobletroque != ''){
                                $proyecto->propietario_dobletroque=$request->propietario_dobletroque;
                                $bandera = true;
                            }

                            if($duracion_proyecto != null || $duracion_proyecto != '' ){
                                $proyecto->duracion_dias=$request->duracion_proyecto;
                                $bandera = true;
                            }

                            if($cantidad_vehiculo_propio != null || $cantidad_vehiculo_propio != ''){
                                $proyecto->cantidad_vehiculo_propio=$request->cantidad_vehiculo_propio;
                                $bandera = true;
                            }

                            if($cantidad_vehiculo_alquilado != null || $cantidad_vehiculo_alquilado != '' ){
                                $proyecto->cantidad_vehiculo_alquilado=$request->cantidad_vehiculo_alquilado;
                                $bandera = true;
                            }

                            if($valor_metrocubico_propio != null || $valor_metrocubico_propio != ''){
                                $proyecto->valor_metrocubico_propio=$request->valor_metrocubico_propio;
                                $bandera = true;
                            }

                            if($valor_metrocubico_alquilado != null || $valor_metrocubico_alquilado != ''){
                                $proyecto->valor_metrocubico_alquilado=$request->valor_metrocubico_alquilado;
                                $bandera = true;
                            }

                            if($valor_contrato != null || $valor_contrato != '' ){
                                $proyecto->valor_contrato=$request->valor_contrato;
                                $bandera = true;
                            }

                            if($valor_anticipo_contrato != null){
                                $proyecto->valor_anticipo_contrato=$request->valor_anticipo_contrato;
                                $bandera = true;
                            }

                            if($antiguedad_vehiculo != null || $antiguedad_vehiculo !=''){
                                $proyecto->antiguedad_vehiculos_anios=$request->antiguedad_vehiculo;
                                $bandera = true;
                            }

                            if($otros_requerimientos != null || $otros_requerimientos != ''){
                                $proyecto->otro_requerimientos =$request->otros_requerimientos;
                                $bandera = true;
                            }

                            if($tipoVias != null || $tipoVias != []){

                                foreach ($tipoVias as $index => $d){

                                    if($d["estado"]== "delete"){
                                        $proyecto->tipoVia()->detach($d["id"]);
                                    }
                                    if($d["estado"]== "new" ){

                                       // $proyecto->tipoVia()->attach($d["tipo_via_id"]);
                                       $proyecto->tipoVia()->attach($d["tipo_via_id"],
                                       $d["tipo_via_id"]==4?['otros'=>$d["otros"]]:[]);
                                    }

                                }

                                $bandera = true;
                            }

                            if($relleno != null || $relleno != []){

                                foreach($relleno as $index => $d){

                                    if($d["estado"]== "delete"){
                                        $proyecto->tipoMaterial()->detach($d["id"]);
                                    }
                                    if($d["estado"]== "new" ){
                                        $proyecto->tipoMaterial()->attach($d["tipo_material_id"]
                                        , $d["tipo_material_id"]==4?['otros'=>$d["otros"]]:[]);
                                    }
                                }

                            }




                        }

                        if($request->costoServicio != null || $request->costoServicio != []){

                            foreach($request->costoServicio as $index => $req){

                                $servicio_id=$req["servicio_id"];
                                $otro_servicio = $req["otro_servicio"];
                                $proveedor_id = $req["proveedor_id"];
                                $forma_pago = $req["forma_pago"];
                                $medio_pago =$req["medio_pago"];
                                $otro_medio_pago = $req["otro_medio_pago"]== null ? '':$req["otro_medio_pago"];
                                $pago_a_realizar = $req["pago_a_realizar"];
                                $estado= $req["estado"];

                                $cambio = false;
                                if ($estado == "update"){

                                    $serv = $servicio_id;

                                    if($servicio_id==4){
                                        $serv = Servicio::create([
                                            'nombre'=>$otro_servicio
                                        ]);
                                        $serv = $serv->id;
                                    }



                                    $proyecCosto = ProyectoCosto::find($req["id"]);

                                    if($proyecCosto != null || $proyecCosto!=[] ){

                                        if($servicio_id != null){
                                            $proyecCosto->servicio_id =  $serv;
                                            $cambio = true;
                                        }
                                        //dd($req["proveedor_id"]);
                                        if ($proveedor_id  != null || $proveedor_id != '')
                                        {
                                            $proyecCosto->proveedor_id =$proveedor_id;
                                            $cambio = true;
                                        }

                                        if($forma_pago != null){
                                            $proyecCosto->forma_pago = $req["forma_pago"];
                                            $cambio = true;
                                        }

                                        if($medio_pago != null){
                                            $proyecCosto->medio_pago = $req["medio_pago"];
                                            $cambio = true;
                                        }

                                        if($otro_medio_pago != null || $otro_medio_pago != ''){
                                            $proyecCosto->otro_medio_pago = $req["otro_medio_pago"];
                                            $cambio = true;
                                        }

                                        if($pago_a_realizar != null || $pago_a_realizar != ''){
                                            $proyecCosto->pago_a_realizar = $req["pago_a_realizar"];
                                            $cambio = true;
                                        }

                                        if($cambio){


                                        $proyecCosto->save();
                                        }

                                    }


                                }

                                if ($estado == "new"){

                                    if($req !=[]){

                                        $serv = $servicio_id;

                                        if($servicio_id==4){
                                            $serv = Servicio::create([
                                                'nombre'=>$otro_servicio
                                            ]);
                                            $serv = $serv->id;
                                        }

                                        ## Creacion de costo Servicio
                                        $costoServicio = ProyectoCosto::create([

                                                'servicio_id'=>$serv,
                                                'proveedor_id'=>$proveedor_id,
                                                'proyecto_id'=>$id,
                                                'forma_pago'=>$forma_pago,
                                                'medio_pago'=>$medio_pago,
                                                'otro_medio_pago'=>$medio_pago=='Otros'?$otro_medio_pago:"" ,
                                                'pago_a_realizar'=>$pago_a_realizar
                                            ]);

                                        ## se cargan los el detalle de los servicios
                                        foreach($req["detalle"] as $index => $costo){

                                            if($costo != []){
                                                $ti = $costo['tipo_costo_servicio_id'];

                                                if($costo["tipo_costo_servicio_id"]== 4){
                                                    $ti = TipoCostoServicio::create([

                                                        'servicio_id'=>$serv,
                                                        'nombre'=>$costo["otro_costo_servicio"]

                                                        ]);
                                                    $ti =$ti->id;
                                                }

                                                $costo = costoServicioDetalle::create([

                                                    'proyecto_costo_servico_id'=>$costoServicio->id,
                                                    'tipo_costo_servicio_id'=>$ti,
                                                    'valor'=>$costo["valor"]

                                                ]);
                                            }
                                        }

                                    }
                                }

                                if($estado == "delete" ){

                                    $proyecCosto = ProyectoCosto::find($req["id"]);
                                    $proyecCosto->delete();
                                }

                                $detalle = $req["detalle"] ;

                                foreach($detalle as $index => $r){

                                   if ($r["id"] != null ||$r["id"] != ''){

                                        $detalleCosto = costoServicioDetalle::find($r["id"]);

                                        $ti = $r['tipo_costo_servicio_id'];

                                        if($r["tipo_costo_servicio_id"]== 4){
                                            $ti = TipoCostoServicio::create([

                                                'servicio_id'=>$serv,
                                                'nombre'=>$r["otro_costo_servicio"]

                                                ]);
                                            $ti =$ti->id;
                                        }

                                        if($r["estado"]=="update"){
                                             $detalleCosto->$ti;
                                        $detalleCosto->valor=$r["valor"];
                                        $detalleCosto->save();
                                        }

                                        if($r["estado"]== "new"){

                                            $costo = costoServicioDetalle::create([

                                                'proyecto_costo_servico_id'=>$req["id"],
                                                'tipo_costo_servicio_id'=>$ti,
                                                'valor'=>$r["valor"]

                                            ]);

                                        }

                                        if($r["estado"]=="delete"){

                                            $detalleCosto->delete();
                                        }




                                   }
                            }

                            }

                        }



                    ###Coondiciones economica
                        if($request->condicones_economicas != null || $request->condiciones_economicas != []){



                            foreach($request->condicones_economicas as $index => $req){

                                if($req["estado"]=='update'){

                                    $nce=$req["nombre_condicion_economica_id"];
                                    if($nce==4){
                                        $nce= NombreCondicionesEconomica::create([
                                            'nombre'=>$req["otro_condicion_economica"]
                                        ]);

                                        $nce=$nce->id;

                                    }

                                    $condicionesEconomicasid= $req["id"];
                                    $nombreCondicionEconomica= $nce;

                                    $formaPago = $req["forma_pago"];
                                    $medioPago = $req["medio_pago"];
                                    $pagoRealizar  = $req["pago_a_realizar"];

                                    $condicionesEconomica = CondicionesEconomica::find($condicionesEconomicasid);

                                    $condicionesEconomica->nombre_condicion_economica_id = $nombreCondicionEconomica;
                                    //$condicionesEconomica->proyecto_id = $proyectoId;
                                    $condicionesEconomica->forma_pago = $formaPago;
                                    $condicionesEconomica->medio_pago = $medioPago;
                                    $condicionesEconomica->pago_a_realizar = $pagoRealizar;

                                    $condicionesEconomica->save();

                                }

                                if($req["estado"]=='new'){

                                    $nce=$req["nombre_condicion_economica_id"];
                                    if($nce==4){
                                        $nce= NombreCondicionesEconomica::create([
                                            'nombre'=>$req["otro_condicion_economica"]
                                        ]);

                                        $nce=$nce->id;

                                    }

                                    $ce = CondicionesEconomica::create([

                                        'nombre_condicion_economica_id'=>$nce,
                                        'proyecto_id'=>$proyecto->id,
                                        'forma_pago'=>$req["forma_pago"],
                                        'medio_pago'=>$req["medio_pago"],
                                        'pago_a_realizar'=>$req["pago_a_realizar"]

                                    ]);

                                }

                                if($req["estado"]=='delete'){
                                    $condicionesEconomica = CondicionesEconomica::find($req["id"]);
                                    $condicionesEconomica->delete();
                                }


                            }
                        }

                        if($request->consumo_pago_estimado != null || $request->consumo_pago_estimado  != []){

                            foreach($request->consumo_pago_estimado as $index=>$req){
                                //dd($req[]);
                                $gastoEO = GastoEstimadoOperaciones::where('nombre' ,$index)->get();
                                $gastoEstimadoProyecto = GastoEstimadoProyecto::find($req["id"]);
                                $gastoEstimadoProyecto->valor = $req["valor"];
                                $gastoEstimadoProyecto->save();

                            }
                        }
                        if($request->recorridos != null ||$request->recorridos != []){
                            foreach($request->recorridos as $index=>$req){
                                $recorrido = RecorridoUbicacionProyecto::find($req["id"]);



                                $recorrido_inicio_id = $req["recorrido_inicio_id"];
                                $recorrido_final_id =$req["recorrido_final_id"];
                                $accion_id =$req["accion_id"];
                                $recorrido->recorrido_inicio_id = $recorrido_inicio_id;
                                $recorrido->recorrido_final_id = $recorrido_final_id;
                                $recorrido->accion_id = $accion_id;

                                $recorrido->save();
                            }
                        }

                        if($bandera){
                            $proyecto->save();

                            }
                            return $proyecto;
             });


            ResponseController::set_messages('update proyecto');
            ResponseController::set_data(['Proyecto'=> $proyecto]);
            return ResponseController::response('OK');
        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');
    }





    public function destroy(Request $request,$id){
        if($request->user()->can('delete_proyecto')){
            Proyecto::find($id)->delete();
        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');
    }

    public function cargarArchivo(Request $request, $id){
        $proyecto= Proyecto::find($id);
        $subirAchivo =new cargarArchivoController;

        $path = 'Proyectos/Contratos/';
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
            ResponseController::set_messages(['Error AL SUBIR ARCHIVO'=>$dataArchivoCargado->mensaje]);
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
### Tipo de vias
    public function tipoVia(Request $request, $id){
        $proyecto = Proyecto::find($id);

        try {
            $proyecto->tipoVia()->attach($request->tipovia_id,
                ['otros'=>$request->otros]);
        }catch (\Exception $e){
            ResponseController::set_errors(true);
            ResponseController::set_messages('Error al agregar el tipo de vias al proyecto   '.$e);
            return ResponseController::response('BAD REQUEST');
        }

        ResponseController::set_messages('tipo de via agregado el proyecto');

        return ResponseController::response('OK');

    }

    public function eliminarTipoVia(Request $request, $id){
        $proyecto = Proyecto::find($id);

        try {
            $proyecto->tipoVia()->detach($request->tipovia_id);
        }catch (\Exception $e){
            ResponseController::set_errors(true);
            ResponseController::set_messages('Error al elimiar el tipo de vias asociado al proyecto   '.$e);
            return ResponseController::response('BAD REQUEST');
        }

        ResponseController::set_messages('tipo de via elimino del proyecto');

        return ResponseController::response('OK');
    }
# Add Relleno de material
    public function addMaterial(Request $request, $id){
        $proyecto = Proyecto::find($id);
        try{
            $proyecto->tipoMaterial()->attach($request->tipo_material_id,
                ['otros'=>$request->otros]);

        }catch (\Exception $e){
            ResponseController::set_errors(true);
            ResponseController::set_messages('Error al agregar el tipo de Reyeno asociado al proyecto --'.$e);
            return ResponseController::response('BAD REQUEST');
        }
        ResponseController::set_messages('El reyeno del material agregado al proyecto');

        return ResponseController::response('OK');
    }
# Eliminar relleno de Material
    public function eliminarTipoMaterial(Request $request, $id){
        $proyecto = Proyecto::find($id);

        try {
            $proyecto->tipoVia()->detach($request->tipo_material_id);
        }catch (\Exception $e){
            ResponseController::set_errors(true);
            ResponseController::set_messages('Error al elimiar el tipo de vias asociado al proyecto   '.$e);
            return ResponseController::response('BAD REQUEST');
        }

        ResponseController::set_messages('tipo de via elimino del proyecto');

        return ResponseController::response('OK');
    }
### Costos Servicio
    public  function  addCostoSevicio(Request $request, $idProyecto){

            $costoServicio = ProyectoCosto::create(
                [
                    'servicio_id'=>$request->servicio_id,
                    'proveedor_id'=>$request->proveedor_id,
                    'proyecto_id'=>$idProyecto,
                    'forma_pago'=>$request->forma_pago,
                    'medio_pago'=>$request->medio_pago,
                    'otro_medio_pago'=>$request->medio_pago=='Otros'?$request->otro_medio_pago:"" ,
                    'pago_a_realizar'=>$request->pago_a_realizar
                ]
            );
            return response($costoServicio->id);
    }
### Detalle costo servicio
    public function  addDetalleCosto(Request $request){
        $costoDetalleCosto = costoServicioDetalle::create([
            'proyecto_costo_servicio_id'=>$request->proyectoCostoServicio,
            'tipo_costo_servicio_id'=>$request->tipoCostoServicio,
            'valor'=>$request->valor
        ]);
    }

    ###


    public function  showTipocostoServicio(Request $request){
        $tipoCostoServicio = TipoCostoServicio::all();
        ResponseController::set_data(['costo_detalle'=>$tipoCostoServicio ]);
        return ResponseController::response('OK');


    }

}
