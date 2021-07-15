<?php

namespace App\Http\Controllers\Proyecto;

use App\Http\Controllers\cargarArchivoController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController;
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

            ResponseController::set_data(['data'=>proyectoAllResource::collection(Proyecto::all()) ]);
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
            Proyecto::find($id)->delete();
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
