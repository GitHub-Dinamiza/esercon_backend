<?php

namespace App\Http\Controllers;

use App\Http\Resources\Validacion\ListaArchivoResource;
use App\Http\Resources\Validacion\ListaArchivoValidacionFechaResource;
use App\Http\Resources\Validacion\ListaDocumentoCargadoResource;
use App\Http\Resources\Validacion\ListaDocumentoCargadoValidacionFechaResource;
use App\Models\ValidacionEstado\ValidacionArchivoEntidad;
use App\Models\Vehiculo\ArchivoVehiculo;
use App\Models\Vehiculos;
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
        $resultArray = array_diff($array1,$array2);

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
        $result = $result->map(function ($data){
            return $data->general_data_id;
        });
        $result1 = ListaArchivoValidacionFechaResource::collection($result);
        return $result1;
    }

    /***
     * @param $model
     * @param $name
     * @param $arrayList
     * @return mixed
     */
    private function listaDocumentoCargadoValidacionFecha($model, $name,$arrayList){
        $result = $model->whereIn($name, $arrayList)->get();
        $result1 = ListaDocumentoCargadoValidacionFechaResource::collection($result);
        $result = $result->map(function ($data){
            $fecha_actual = strtotime(date("d-m-Y H:i:00",time()));
            $fecha_entrada = strtotime($data->fecha_espedicon);
            if($fecha_actual >= $fecha_entrada){
                $result =false;
            }else{
                $result = true;
            }

            return $result;

        });
        return $result;
    }

    public  function  validarListaFechaExpiracion($model, $name, $arraylist){
        $countListDocuement = count($arraylist);
        $listArchivo = $this->listaDocumentoCargadoValidacionFecha($model,'tipo_archivo_id',$arraylist);
        $countListArchivo = 0;
        foreach ($listArchivo as  $data){
            if ($data){
                $countListArchivo = $countListArchivo +1;
            }
        }

        if($countListDocuement <= $countListArchivo)
        {
            $result = true;
        }else{$result= false;}

        return $result;
    }

    /***
     * @param $modelEntidad
     * @param $modelArchivo
     * @param $nameColumnaId
     * @param $entidadId
     * @param $nameEntidad
     * @return string
     */
    public  function  activacionEstado($modelEntidad, $modelArchivo,$nameColumnaId,$entidadId,$nameEntidad,$nameColumnaArchivoId){
        $listDocument = $this->listadoDocumentoCargado($modelArchivo,$nameColumnaId,$entidadId);
        $listArchivo = $this->listarchivo($nameEntidad);

        $listArchivoValidacionFecha = $this->listArchivoValidacionFecha($nameEntidad);

        $validacionLista = $this->validacionLista($listArchivo,$listDocument);

        $validacionFecha = $this->validarListaFechaExpiracion($modelArchivo,$nameColumnaArchivoId,$listArchivoValidacionFecha);

        if($validacionLista == true && $validacionFecha == true){

            if ($modelEntidad->estado_id == 39 || $modelEntidad->estado_id ==40){
                $modelEntidad->update([
                    'modelEntidad'=>38
                ]);
                $modelEntidad->save();
            }
            return 'Actualizado estado';

        }else{
            if ($modelEntidad->estado_id == 38){
                $modelEntidad->update([
                    'modelEntidad'=>40
                ]);
                $modelEntidad->save();
            }
            return  'Desaticado estado';
        }


    }

    public  function  desativacionEstado(){

    }


    public  function prueba(){
        $result= $this->listarchivo('vehiculo');

        $archvVehiculo = new ArchivoVehiculo();
        $vehiculo = new Vehiculos();
        $result1 = $this->listadoDocumentoCargado($archvVehiculo,'vehiculo_id',3);
        $listArch = $this->listArchivoValidacionFecha('vehiculo');
        $result = $this->validarListaFechaExpiracion($archvVehiculo,'tipo_archivo_id',$listArch);
        //return $result;
       // return $result;
        //return $this->validacionLista($result, $result1);

        return $this->actvacionEstado($vehiculo,$archvVehiculo,'vehiculo_id',3,'vehiculo','tipo_archivo_id');
        //return $this->listArchivoValidacionFecha();
    }

}
