<?php

namespace App\Models\Operaciones;

use App\Models\AsignacionRecurso\AsignacionConductor;
use App\Models\AsignacionRecurso\AsignacionRecurso;
use App\Models\Persona\Conductor;
use App\Models\ProyectoCosto;
use App\Models\Vehiculo\Vehiculos;
use http\Env\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CargaCombustibleDiario extends Model
{
    use HasFactory;
     protected $table = 'carga_combustible_diario';

     protected $fillable = [
         'vehiculo_id'
         ,'conductor_id'
         ,'proveedor_servicio_id'
         ,'fecha_registro'
         ,'tipo_combustible'
         ,'valor_galon'
         ,'total_galon'
         ,'user_id'
     ];

     public function vehiculo(){
         return $this->belongsTo(Vehiculos::class,'vehiculo_id');
     }

     public function conductor(){
         return $this->belongsTo(Conductor::class,'conductor_id');
     }

     public function proveedorServicio (){
         return $this->belongsTo(ProyectoCosto::class, 'proveedor_servicio_id');
     }
     public static function  allData(){
         try {
             $dataReturn['date'] =CargaCombustibleDiario::all();
         }catch (\Exception $e){
             self::$dataReturn['errors']= true;
             self::$dataReturn['mensaje']=  "Vehiculo no asociado a conductor";
             self::$dataReturn['state']= 'INTERNAL SERVER ERROR';
         }

         return  $dataReturn;
     }

     public static function createData($request){

         $asignacionRecuso = AsignacionRecurso::where('vehiculo_id', $request->vehiculo_id)->first();
         $asinaConductor = AsignacionConductor::where('vehiculo_id', $request->vehiculo_id)->first();

         if(!empty($asignacionRecuso)){
             if(!empty($asinaConductor)){
                 try {
                     $cargaCombustibre = self::create([
                         'vehiculo_id'=>$request->vehiculo_id
                         ,'conductor_id'=>$asinaConductor ->conductor_id
                         ,'proveedor_servicio_id'=>$request->proveedor_servicio_id
                         ,'fecha_registro'=>$request->fecha_registro
                         ,'tipo_combustible'=>$request->tipo_combustible
                         ,'valor_galon'=>$request->valor_galon
                         ,'total_galon'=>$request->total_galon
                         ,'user_id'=>$request->user()->id


                     ]);
                     self::$dataReturn['data']=$cargaCombustibre;
                     self::$dataReturn['state']= 'OK';
                 }catch (\Exception $e){
                     self::$dataReturn['errors']= true;
                     self::$dataReturn['mensaje']=  "Vehiculo no asociado a conductor";
                     self::$dataReturn['state']= 'INTERNAL SERVER ERROR';
                 }



             }else{
                 self::$dataReturn['errors']= true;
                 self::$dataReturn['mensaje']=  "Vehiculo no asociado a conductor";
                 self::$dataReturn['state']= 'BAD REQUEST';
             }
         }else{
             self::$dataReturn['errors']= true;
             self::$dataReturn['mensaje'][]= "Vehiculo no asociado a proyecto";
             self::$dataReturn['state']= 'BAD REQUEST';
         }


         return  self::$dataReturn;
     }

     public function updateData($request, $id){

         try{
             $asignacionRecuso = AsignacionRecurso::where('vehiculo_id', $request->vehiculo_id)->first();
             $asinaConductor = AsignacionConductor::where('vehiculo_id', $request->vehiculo_id)->first();
             if(!empty($asignacionRecuso)){
                 if(!empty($asinaConductor)){
                     $data = self::find($id);
                     $data ->update([

                         'vehiculo_id'=>$request->vehiculo_id
                         ,'conductor_id'=>$asinaConductor ->conductor_id
                         ,'proveedor_servicio_id'=>$request->proveedor_servicio_id
                         ,'fecha_registro'=>$request->fecha_registro
                         ,'tipo_combustible'=>$request->tipo_combustible
                         ,'valor_galon'=>$request->valor_galon
                         ,'total_galon'=>$request->total_galon
                         ,'user_id'=>$request->user()->id
                     ]);
                     self::$dataReturn['data']=$data;
                     self::$dataReturn['state']= 'OK';

                 }else{
                     self::$dataReturn['errors']= true;
                     self::$dataReturn['mensaje']=  "Vehiculo no asociado a conductor";
                     self::$dataReturn['state']= 'BAD REQUEST';
                 }
             }else{
                 self::$dataReturn['errors']= true;
                 self::$dataReturn['mensaje'][]= "Vehiculo no asociado a proyecto";
                 self::$dataReturn['state']= 'BAD REQUEST';
             }
         }catch (\Exception $e){
             self::$dataReturn['errors']= true;
             self::$dataReturn['mensaje']=  "Vehiculo no asociado a conductor";
             self::$dataReturn['state']= 'INTERNAL SERVER ERROR';
         }

         return  self::$dataReturn;
    }

    public static function deleteData($id){
        try{
           $data = self::find($id);
            $data->delete();
            self::$dataReturn['mensaje']=  "Registro eliminado";
            self::$dataReturn['state']= 'OK';
        }catch (\Exception $e){
            self::$dataReturn['errors']= true;
            self::$dataReturn['mensaje']=  "Vehiculo no asociado a conductor";
            self::$dataReturn['state']= 'INTERNAL SERVER ERROR';
        }

        return  self::$dataReturn;
    }
}
