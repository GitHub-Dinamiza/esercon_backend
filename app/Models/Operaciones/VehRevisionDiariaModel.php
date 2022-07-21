<?php

namespace App\Models\Operaciones;

use App\Models\User;
use App\Models\Vehiculo\Vehiculos;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehRevisionDiariaModel extends Model
{
    use HasFactory;

    protected $table = 'veh_revision_daria';

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

}
