<?php

namespace App\Http\Controllers;

use App\Http\Resources\User\userResources;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public  function  store(Request $request){
        if(!$user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)

        ])){
            ResponseController::set_errors(true);
            ResponseController::set_messages("Error creando el usuario");
            return  ResponseController::response('BAD REQUEST');
        }

        ResponseController::set_messages("Usuario creado");
        ResponseController::set_data(['user_id'=>$user->id]);
        return ResponseController::response('CREATED');
    }

    public function  get($id){
        $validator = Validator::make(['id_user'=>$id],[
            'id_user'=>'required|integer|min:1|exists:users,id',
        ]);

        if ($validator->fails()) {
            ResponseController::set_errors(true);
            ResponseController::set_messages($validator->errors()->toArray());
            return ResponseController::response('BAD REQUEST');

        }

        ResponseController::set_data(['user' => User::find($id)]);
        return ResponseController::response('OK');
    }



    public function get_all(){
        $user =User::all();
       // dd($user);
        //$user->persona->get();
        $user = userResources::collection($user);
            ResponseController::set_data(['users'=>$user]);
            return ResponseController::response('OK');



    }


    public function getDocumento(){

    }

    public function  update(Request $request){

    }

    public function destroy($id){
        if(User::find($id)->delete()){

            ResponseController::set_messages("Usuario elimindado correctament");
            return ResponseController::response('OK');
        }
    }


}
