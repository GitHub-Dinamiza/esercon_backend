<?php

namespace App\Models\ValidacionEstado;

use App\Models\GeneralData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ValidacionArchivoEntidad extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable =['general_data_id','entidad','valida_fecha'];
    protected  $table = 'validacion_archivo_entidad';

    public function generalData(){
        return $this->belongsTo(GeneralData::class,'documento_id');
    }
}
