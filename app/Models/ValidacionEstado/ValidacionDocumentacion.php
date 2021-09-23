<?php

namespace App\Models\ValidacionEstado;

use App\Models\GeneralData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValidacionDocumentacion extends Model
{
    use HasFactory;

    protected $fillable = ['documento_id'];

    protected $table = 'validacion_documentacions';

    public function generalData(){
        return $this->belongsTo(GeneralData::class,'documento_id');
    }

}
