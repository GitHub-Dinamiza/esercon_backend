<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use PhpParser\Comment\Doc;

class Proveedor extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'razon_social','primer_nombre','primer_apellido',
        'segundo_nombre','segundo_apellido','tipo_proveedor',
        'direccion','telefono','email','municipio_id','user_id'
    ];

    protected $table ='proveedores';

    public function  numeroDocumento(){

       return $this->hasMany(DocumentoProveedor::class);
    }

    public function scopeFiltro($query, $filtro){
            return $query->where('razon_social','like',"%$filtro%")->get();
    }
}
