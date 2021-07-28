<?php

namespace App\Http\Controllers\RestaurarContrasenia;

use App\Http\Controllers\Controller;
use App\Mail\restaurarContrasenia;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RestauraContraseniaController extends Controller
{

    public function recuperarContronseña(Request $request){

        $email = $request->email;
        $user = User::pluck('email');
        Mail::to($email)->send(new restaurarContrasenia($user));


        if($user =User::where()->firts()){

        }

    }


}
