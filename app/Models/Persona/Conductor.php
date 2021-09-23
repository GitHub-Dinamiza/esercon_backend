<?php

namespace App\Models\Persona;

use App\Models\Proveedor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conductor extends Model
{
    use HasFactory, SoftDeletes;

    protected $table ='conductors';

    protected $fillable = ['persona_id', 'proveedor_id','nombre_contacto','telefono_contacto', 'estado'];

    public function persona(){
        return $this->belongsTo(Persona::class, 'persona_id');
    }

    public function proveedor(){
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }
}
