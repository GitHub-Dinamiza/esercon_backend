<?php

namespace App\Http\Controllers;

use App\Http\Resources\Validacion\ListaArchivoResource;
use App\Http\Resources\Validacion\ListaArchivoValidacionFechaResource;
use App\Http\Resources\Validacion\ListaDocumentoCargadoResource;
use App\Http\Resources\Validacion\ListaDocumentoCargadoValidacionFechaResource;
use App\Models\ValidacionEstado\ValidacionArchivoEntidad;
use App\Models\Vehiculo\ArchivoVehiculo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ValidarEstadoEntidadController extends Controller
{
    /***
     * compara dos  array y debuelve un booleano
     *  true =  la comparacion debuelve un array vacio
     *  false = la comparacion devuelve un arraay  con datos
    */
    public function validacionLista($array1 , $array2){
        $resultArray = $array1->diff($array2);

        if(empty($resultArray)){
            $result = true;
        }else{
            $result = false;
        }

        return $result;
    }

    public function validacionLista2($array1){
        $result= $array1->map(function ($data){
          //  dd($data->tipo_archivo_id);
            return $data->tipo_archivo_id;
        });

        return $result->toArray();
    }


    public  function  validacionFecha($fecha ){
        $fechaActual = DateTime("now");
        $fechaExpedicion = DateTime($fecha);
        if($fechaActual >= $fechaExpedicion){
            $result = true;
        }else{
            $result = false;
        }
        return $result;
    }


    public function  listarchivo($entidad){

      $result =  ValidacionArchivoEntidad::where('entidad',$entidad)->get();
      $result = ListaArchivoResource::collection($result);
        $result= $result->map(function ($data){
            //  dd($data->tipo_archivo_id);
            return $data->general_data_id;
        });

        return $result->toArray();
    }

    //listado de documentos cargados
    public function  listadoDocumentoCargado($model,$name, $id){
        $result = $model->where($name, $id)->get();

        $result1 = ListaDocumentoCargadoResource::collection($result);
        $result1= $result1->map(function ($data){
            //  dd($data->tipo_archivo_id);
            return $data->tipo_archivo_id;
        });

        return $result1->toArray();

    }

    private function  listArchivoValidacionFecha($entidad){
        $result =  ValidacionArchivoEntidad::where('entidad',$entidad)
                   ->where('valida_fecha',true)->get();

        $result1 = ListaArchivoValidacionFechaResource::collection($result);
        return $result1;
    }

    public function listaDocumentoCargadoValidacionFecha($model, $name,$id){
        $result = $model->where($name, $id)->get();
        $result1 = ListaDocumentoCargadoValidacionFechaResource::collection($result);

        return $result1;
    }

    public  function  validarListaFechaExpiracion($array1, $array2){

    }


    public  function  actvacionEstado($model){

    }

    public  function  desativacionEstado(){

    }


    public  function prueba(){
        $result= $this->listarchivo('vehiculo');

        $archvVehiculo = new ArchivoVehiculo();
        $result1 = $this->listadoDocumentoCargado($archvVehiculo,'vehiculo_id',3);
        //$result = $this->listArchivoValidacionFecha('vehiculo');
        //$result = $this->listaDocumentoCargadoValidacionFecha($archvVehiculo,'vehiculo_id',3);
        return array_diff($result, $result);

    }

}
