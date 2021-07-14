<?php

namespace App\Http\Controllers\RolePermission;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController;
use App\Models\Role;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    public function store(Request $request){

        if(
            !$role = Role::create([
                'name' =>$request->name,
                'slug' =>$request->slug,
            ])
        ){
            ResponseController::set_errors(true);
            ResponseController::set_messages("Error creando el rol");
            return ResponseController::response('BAD REQUEST');
        }
        ResponseController::set_messages("Rol creado correctamente");
        ResponseController::set_data(['id_role' => $role->id]);
        return ResponseController::response('CREATED');
    }

    public  function get_all(){
        ResponseController::set_data(['roles'=>Role::all()]);
        return ResponseController::response('OK');

    }

    public function get($id){
        ResponseController::set_data(['rol'=>Role::find($id)]);
        return ResponseController::response('OK');
    }

    public function destroy($id){
        try{
            Role::destroy($id);
        }catch (\Exception $e){
            ResponseController::set_errors(true);
            ResponseController::set_messages("error eliminado el role");
            ResponseController::set_messages($e->getMessage());
            return ResponseController::response('BAD REQUEST');
        }
        ResponseController::set_messages("role eliminado");
        return ResponseController::response('OK');
    }

    public function update($id,Request $request)
    {
        try{
            $role = Role::find($id);
            $role->name = $request->name;
            $role->slug =$request->slug;
            $role->save;
        } catch (\Exception $e){
            ResponseController::set_errors(true);
            ResponseController::set_messages("error actualizando el rol");
            ResponseController::set_messages($e->getMessage());
        }
        ResponseController::set_messages("role actualizado");
        ResponseController::set_data(['id_role' => $role->id]);
        return ResponseController::response('OK');
    }

    //PERMMISSION

    public function permission($rol_id){

        $role= Role::find($rol_id);
        $role->permissions;
       /* $permissions =[];

        foreach ($role as $index=>$rol){
            foreach ($rol->permissions as $permission){
                $permissions[$permission->id]=$permission->name;
            }
        }*/
        ResponseController::set_data(['permissions' => $role->permissions]);

        return ResponseController::response('OK');
    }

    public function add_permission($rol_id, Request $request)
    {
        $role = Role::find($rol_id);
        try {
            $role->permissions()->attach($request->permission_id);
        }catch (\Exception $e){
            ResponseController::set_errors(true);
            ResponseController::set_messages("error asignando el permiso");
            ResponseController::set_messages($e->getMessage());
            return ResponseController::response('BAD REQUEST');
        }
        ResponseController::set_messages("permiso asignado");
        return ResponseController::response('OK');
    }

    public function remove_permission($rol_id, Request $request){

        $role = Role::find($rol_id);

        try{
            $role->permissions()->detach($request->permission_id);
        }catch (\Exception $e){
            ResponseController::set_errors(true);
            ResponseController::set_messages("error eliminando el permiso");
            ResponseController::set_messages($e->getMessage());
            return ResponseController::response('BAD REQUEST');
        }
        ResponseController::set_messages("permiso eliminado");
        return ResponseController::response('OK');
    }
}
