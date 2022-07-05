<?php

namespace App\Models\Persona;

use App\Models\experiensiaLaboral;
use App\Models\GeneralData;
use App\Models\Municipio;
use App\Models\TipoDocumento;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class  Persona extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'personas';

    protected $fillable = [
        'primer_nombre','segundo_nombre',
        'primer_apellido', 'segundo_apellido',
        'tipo_documento_id','numero_documento',
        'ciudad_residencia_id','direccion',
        'telefono','email','estado_civil',
        'tipo_sangle_id','eps_id',
        'arl_id'
    ];

    public  function tipoDocumento(){
        return $this->belongsTo(TipoDocumento::class,'tipo_documento_id' );
    }



    public function arl(){
        return $this->belongsTo(GeneralData::class, 'arl_id');
    }

    public function eps(){
        return $this->belongsTo(GeneralData::class, 'eps_id');
    }

    public function tipoSangle(){
        return $this->belongsTo(GeneralData::class, 'tipo_sangle_id');
    }

    public function estadoCivil(){
        return $this->belongsTo(GeneralData::class, 'estado_civil');
    }

    public function estado(){
        return $this->belongsTo(GeneralData::class, 'estado');
    }

    public function experienciaLaboral(){
        return $this->hasMany(experiensiaLaboral::class,'persona_id');
    }

    public function archivo(){
        return $this->hasMany(ArchivosPersona::class, 'persona_id');
    }

    public  function municipoRes (){
        return $this->belongsTo(Municipio::class, 'ciudad_residencia_id');
    }



}
