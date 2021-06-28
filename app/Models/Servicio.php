<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Servicio extends Model
{
    use HasFactory, SoftDeletes;

    protected $table ='servicios';
    protected $fillable =['nombre'];
    public $timestamps =false;
    public function detalleCosto(){
        return  $this->hasMany(TipoCostoServicio::class);
    }

    public function scopeNombres($query, $nombre){
        if($nombre){
            return $query->where('nombre','like',"%$nombre%")->get();
        }else{
            return $query->all();
        }

    }

}
