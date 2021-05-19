<?php

namespace App\Http\Controllers\RolePermission;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController;
use App\Models\Permission;
use App\Models\Role;
use http\Env\Response;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function store(Request $request){
        if(!$permission= Permission::create([
            'name'=>$request->name,
            'slug'=>$request->slug
        ])){
            ResponseController::set_errors(true);
            ResponseController::set_messages("Error creando el permiso");
            return ResponseController::response('BAD REQUEST');
        }

        ResponseController::set_messages("Permiso creado");
        ResponseController::set_data(['permission_id' => $permission->id]);
        return ResponseController::response('CREATED');

    }

    public function get_all(){
        ResponseController::set_data(['permissions' => Permission::all()]);
        return ResponseController::response('OK');
    }

    public function get($id){
        ResponseController::set_data(['permission' => Permission::find($id)]);
        return ResponseController::response('OK');
    }

    public function update($id,Request $request){
        try {
            $permission =Permission::find($id);
            $permission->name = $request->name;
            $permission->slug = $request->slug;
            $permission->save();

        }catch (\Exception $e){
            ResponseController::set_errors(true);
            ResponseController::set_messages("error actualizando el permiso");
            ResponseController::set_messages($e->getMessage());
            return ResponseController::response('BAD REQUEST');
        }
        ResponseController::set_messages("permiso actualizado");
        ResponseController::set_data(['permiso_id' => $permission->id]);
        return ResponseController::response('OK');
    }

    public function destroy($id){
        try {
            Permission::destroy($id);
        } catch (\Exception $e) {
            ResponseController::set_errors(true);
            ResponseController::set_messages("error eliminado el permiso");
            ResponseController::set_messages($e->getMessage());
            return ResponseController::response('BAD REQUEST');
        }

        ResponseController::set_messages("permiso eliminado");
        return ResponseController::response('OK');
    }

    //ROLES
}
