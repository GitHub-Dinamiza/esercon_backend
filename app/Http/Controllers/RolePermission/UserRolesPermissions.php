<?php

namespace App\Http\Controllers\RolePermission;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController;
use App\Http\Resources\Permissions;
use App\Http\Resources\PermissionsCollection;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Collection;
use PhpParser\Node\Stmt\Return_;

class UserRolesPermissions extends Controller
{


    //ROLES
    public function roles($user_id){

        $user = User::find($user_id);
        ResponseController::set_data(['roles' => $user->roles]);
        return ResponseController::response('OK');

    }


    public function add_rol(Request $request,$user_id){
        $user =User::find($user_id);
        if(!$user){
            ResponseController::set_errors(true);
            ResponseController::set_messages("usuario no valido");
            return ResponseController::response('BAD REQUEST');
        }

        try {
            $user->roles()->attach($request->rol_id);
        }catch (\Exception $e){
            ResponseController::set_errors(true);
            ResponseController::set_messages("error asignando el rol");
            ResponseController::set_messages($e->getMessage());
            return ResponseController::response('BAD REQUEST');
        }
        ResponseController::set_messages("rol asignado");
        //ResponseController::set_data(['roles' => $user->roles]);
        return ResponseController::response('CREATED');

    }

    public function remove_rol(Request $request, $user_id){
        $user =User::find($user_id);
        if(!$user){
            ResponseController::set_errors(true);
            ResponseController::set_messages("usuario no valido");
            return ResponseController::response('BAD REQUEST');
        }

        try {
            $user->roles()->detach($request->rol_id);
        }catch (\Exception $e){
            ResponseController::set_errors(true);
            ResponseController::set_messages("error al eliminar  rol");
            ResponseController::set_messages($e->getMessage());
            return ResponseController::response('BAD REQUEST');
        }
        ResponseController::set_messages("rol removido");
        return ResponseController::response('OK');
    }

    //permisos
    public function permissions($user_id){
        $user =User::find($user_id);

        if(!$user){
            ResponseController::set_errors(true);
            ResponseController::set_messages("usuario no valido");
            return ResponseController::response('BAD REQUEST');
        }
        if( !$user->roles->isEmpty()){
            foreach ($user->roles as $index=>$rol){

                $permissionRol= $rol->permissions;

            }

        }else{
            $permissionRol= Collect([]);
        }

        $permissionUser = $user->permissions;
        $union =$permissionRol->merge( $user->permissions);

        $permissions=PermissionsCollection::make($union);
        ResponseController::set_data(['permission'=>$permissions]);
        return ResponseController::response("OK");
    }

    public function __permissions($user_id){
        $user =User::find($user_id);

        if(!$user){
            ResponseController::set_errors(true);
            ResponseController::set_messages("usuario no valido");
            return ResponseController::response('BAD REQUEST');
        }
        if(!$user->roles->isEmpty()){
            foreach ($user->roles as $index=>$rol){
                $permissionRol= $rol->permissions;
            }
        }else{
            $permissionRol= Collect([]);
        }

        $permissionUser = $user->permissions;
        $union =$permissionRol->merge( $user->permissions);

        $GeneralP =Permission::all();

        $permissions= $GeneralP->diff($union);

        ResponseController::set_data(['permission'=>$permissions]);
        return ResponseController::response("OK");



    }

    public function add_permission($user_id, Request $request){
        $user = User::find($user_id);
        if($request->permission_id != "" || $request->permission_id != null){
            try{
                $user->permissions()->attach($request->permission_id);
            }catch (\Exception $e){
                ResponseController::set_errors(true);
                ResponseController::set_messages($e->getMessage());
                return ResponseController::response('BAD REQUEST');
            }
            ResponseController::set_messages("Permiso agignado");
            return ResponseController::response('CREATED');
        }else{
            ResponseController::set_errors(true);
            ResponseController::set_messages("No ha permiso que asignar");
            return ResponseController::response('BAD REQUEST');
        }



    }

    public function  remove_permission($user_id, Request $request){
        $user = User::find($user_id);
        try{
            $user->permissions()->detach($request->permission_id);
        }catch (\Exception $e){
            ResponseController::set_errors(true);
            ResponseController::set_messages("error eliminando permiso");
            ResponseController::set_messages($e->getMessage());
            return ResponseController::response('BAD REQUEST');
        }

        ResponseController::set_messages("Permiso eliminado");
        return ResponseController::response('OK');
    }


}
