<?php

namespace App\Models\Operaciones;

use App\Models\User;
use App\Models\Vehiculo\Vehiculos;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Boolean;
use function PHPUnit\Framework\isEmpty;

class VehRevisionDiariaModel extends Model
{
    use HasFactory;

    protected $table = 'veh_revision_daria';
    protected  static  $dataReturn= [
        'data'=>[]
        ,'state'=>'OK'
        ,'state'=>false
        ,'mensaje'=>[]
    ];

    protected $fillable = [
        'veh_item_revision_id','vehiculo_id',
        'valor','comentario','fecha_revision',
        'hora', 'user_id','proyecto_id','responsable_id'
    ];

    public function  user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function vehiculo(){
        return $this->belongsTo(Vehiculos::class, 'vehiculo_id');
    }
    public function itemRevision(){
        return $this->belongsTo(VehItemRevisionModel::class,'veh_item_revision_id');
    }

    public function evidencia(){
        return $this->hasMany(DocumentoRevisionDiaria::class, 'veh_revision_daria_id');
    }


    public static function revisionDia($veiculo_id, $fecha){
        try {
            $data = self::where('vehiculo_id', $veiculo_id)
                ->where('fecha_revision',$fecha)->get();
            self::$dataReturn['data']= $data;
            self::$dataReturn['state']= 'OK';
        }catch (\Exception $e){
            self::$dataReturn['errors']= true;
            self::$dataReturn['mensaje']=  $e;
            self::$dataReturn['state']= 'INTERNAL SERVER ERROR';
        }

        return self::$dataReturn;
    }

    public function ValidadorRegistro ($id, $fecha){


    }
    public static function actaRevision($idVehiculo, $fecha)
    {
        $data = self::where('vehiculo_id',$idVehiculo)
                ->where('fecha_revision', $fecha)->get();
        $data = $data->filter(function ($value, $key){
            return $value['veh_item_revision_id'] == 8;
        })->
        mapWithKeys(function ($item,$key){
            return $item->evidencia;
        });
       return count($data)>0 ? true:false ;

    }

    public static function estadoRevision($idVehiculo, $fecha){

        $data = self::where('vehiculo_id',$idVehiculo)
            ->where('fecha_revision', $fecha)->get();

        $data = $data->filter(function ($value, $key){
            return $value['valor']=="true";
        });
        $estadoData = count($data) ==12 ? true : false ;
        $acta =  $revicion = VehRevisionDiariaModel::actaRevision($idVehiculo,$fecha);

        if ($estadoData && $acta){
            return true ;
        }else{
            return false;
        }


    }

}
