<?php

namespace App\Models;

use App\Models\Provedores\ArchivoProveedor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use PhpParser\Comment\Doc;

class Proveedor extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'razon_social','codigo','primer_nombre','primer_apellido',
        'segundo_nombre','segundo_apellido','tipo_proveedor',
        'direccion','telefono','email','municipio_id','user_id','estado'
    ];

    protected $table ='proveedores';

    public function scopeEstado($query){
        return $query->where('estado','like',"%activo%")->get();
        }

    public function  numeroDocumento(){

       return $this->hasMany(DocumentoProveedor::class);
    }

    public function municipio(){
        return $this->belongsTo(Municipio::class, 'municipio_id');
    }

    public function archivo(){
        return $this->hasMany(ArchivoProveedor::class, 'proveedor_id');
    }

    public function scopeFiltro($query, $filtro){
            return $query->where('razon_social','like',"%$filtro%")->get();
    }
}
