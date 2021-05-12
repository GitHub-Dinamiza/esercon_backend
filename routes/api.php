<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix'=>'v1'], function(){

    Route::group(['prefix'=>'auth'], function(){

        //Login
        Route::post('login','App\Http\Controllers\Auth\AuthController@login');
        //REGISTRO DE USUARIO
        Route::post('signup','App\Http\Controllers\Auth\AuthController@signUp');

        Route::group(['middleware'=>'auth:api'],function (){

            //LOGOUT
            Route::get('logout','App\Http\Controllers\Auth\AuthController@logout');

            //LISTA DE TODOS LOS USUARIOS
            Route::get('user','App\Http\Controllers\Auth\AuthController@user');


        });

    });
});
