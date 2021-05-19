<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ['name','slug'];

    protected $hidden = ['created_at','updated_at'];

    public function permissions() {

        return $this->belongsToMany(Permission::class,'roles_permissions');

    }

    public function users() {

        return $this->belongsToMany(User::class,'users_roles');

    }
}
