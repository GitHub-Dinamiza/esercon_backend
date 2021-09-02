<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Proyecto\ProyectoController;
use App\Http\Controllers\Proyecto\UbicacionRecorridoController;

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




    Route::group(['prefix'=>'auth'], function(){

        //Login
        Route::post('login','Auth\AuthController@login');
        //REGISTRO DE USUARIO
        Route::post('signup','Auth\AuthController@signUp');

        Route::group(['middleware'=>'auth:api'],function (){

            //LOGOUT
            Route::get('logout','Auth\AuthController@logout');

            //LISTA DE TODOS LOS USUARIOS
            Route::get('user','Auth\AuthController@user');


        });

    });


Route::group(['middleware'=>'auth:api'],function (){

    //LOACALISACION
    Route::group(['prefix'=>'departamentos'], function(){
        Route::get('', 'LocalizacionController@show');
        Route::get('{id}', 'LocalizacionController@get');
        Route::get('{id}/municipios', 'LocalizacionController@showMunicipios');

    });
    Route::get('municipio/{id}', 'LocalizacionController@getMunicipio');

    //TIPO DE DOCUMENTOS
    Route::group(['prefix'=>'tipo_documento'],function(){
        Route::get('', 'TipoDocumentoController@show');
        Route::get('{id}','TipoDocumentoController@get');
    });

    Route::group(['middleware'=>'role:dev'],function(){
        //USUARIOS
        Route::group(['prefix'=>'usuarios'], function(){
            Route::post('','UserController@store');
            Route::get('', 'UserController@get_all');
            Route::get('{id}', 'UserController@get');
            Route::delete('{id}','UserController@destroy');

            //Roles y permisos
            Route::get('{user_id}/role', 'RolePermission\UserRolesPermissions@roles');
            Route::post('{user_id}/role', 'RolePermission\UserRolesPermissions@add_rol');
            Route::delete('{user_id}/role', 'RolePermission\UserRolesPermissions@remove_rol');

            Route::get('{user_id}/permissions', 'RolePermission\UserRolesPermissions@permissions');
            Route::get('{user_id}/permissions/asignar', 'RolePermission\UserRolesPermissions@__permissions');
            Route::post('{user_id}/permissions', 'RolePermission\UserRolesPermissions@add_permission');
            Route::delete('{user_id}/permissions', 'RolePermission\UserRolesPermissions@remove_permission');
        });

        Route::group(['prefix'=>'roles'],function (){
            Route::post('','RolePermission\RoleController@store');
            Route::get('','RolePermission\RoleController@get_all');
            Route::get('{id}','RolePermission\RoleController@get');
            Route::put('{id}','RolePermission\RoleController@update');
            Route::delete('{id}','RolePermission\RoleController@destroy');
            //permission
            Route::get('{rol_id}/permissions', 'RolePermission\RoleController@permission');
            Route::post('{rol_id}/permissions', 'RolePermission\RoleController@add_permission');
            Route::delete('{rol_id}/permissions', 'RolePermission\RoleController@remove_permission');

        });

        Route::group(['prefix'=>'permissions'],function(){
            Route::post('','RolePermission\PermissionController@store');
            Route::get('','RolePermission\PermissionController@get_all');
            Route::get('{id}','RolePermission\PermissionController@get');
            Route::put('{id}','RolePermission\PermissionController@update');
            Route::delete('{id}','RolePermission\PermissionController@destroy');
        });

        ##Proveedor
        Route::group(['prefix'=>'proveedor'],function (){
            Route::get('','Proveedor\ProveedorController@show');
            Route::post('','Proveedor\ProveedorController@store');
            Route::put('{id}','Proveedor\ProveedorController@updateProveedor');
            Route::post('/{id}/tipoArchivo/{idTipoArchivo}/Archivo','Proveedor\ProveedorController@cargarArchivo');
            Route::get('/{id}/Archivo','Proveedor\ProveedorController@getArchivo');


            Route::get('/filtro','Proveedor\ProveedorController@show');
            Route::get('/filtro/{filtro}', 'Proveedor\ProveedorController@filtro');
            Route::post('/tipos_archivos','Proveedor\ProveedorController@tipoArchivo');
        });

        //Proyecto
        Route::group(['prefix'=>'proyecto'],function (){


            Route::post('','Proyecto\ProyectoController@store');
            Route::get('','Proyecto\ProyectoController@show');
            Route::get('{id}','Proyecto\ProyectoController@get');
            Route::delete('{id}','Proyecto\ProyectoController@destroy');
            Route::patch('{id}','Proyecto\ProyectoController@update1');
            Route::post('validador', 'Proyecto\ProyectoController@validadorProyecto');

            Route::post('{id}/documento','Proyecto\ProyectoController@cargarArchivo');
            Route::delete('{id}/documento','Proyecto\ProyectoController@borrarAchivo');

            Route::post('{id}/tipovias','Proyecto\ProyectoController@tipoVia');
            Route::delete('{id}/tipovias','Proyecto\ProyectoController@eliminarTipoVia');

            # Reyeno material
            Route::post('{id}/relleno','Proyecto\ProyectoController@addMaterial');
            Route::delete('{id}/relleno','Proyecto\ProyectoController@eliminarTipoMaterial');
            #Servicios
            Route::post('/servicios','Proyecto\ServiciosController@store');


        });
### VEHICULO
        Route::group(['prefix'=>'vehiculo'],function(){

            Route::post('','Vehiculo\VehiculoController@addVehiculo');
            Route::get('','Vehiculo\VehiculoController@getVehiculo');
            Route::delete('','Vehiculo\VehiculoController@deleteVehiculo');

            Route::post('/caracteristica','Vehiculo\VehiculoController@addCarateristicaVehiculo');
            Route::get('/caracteristica','Vehiculo\VehiculoController@getCarateristicaVehiculo');

            Route::group(['prefix'=>'modelo'],function(){

                Route::post('','Vehiculo\VehiculoController@addTipoVehiculo');
                Route::get('','Vehiculo\VehiculoController@getTipoVehiculo');

            });
             ### Marca
            Route::group(['prefix'=>'marca'],function(){
            Route::post('', 'Vehiculo\VehiculoController@addMarca');
            Route::get('', 'Vehiculo\VehiculoController@getMarca');
            });

            Route::group(['prefix'=>'asignacionCarasteristica'], function(){
                Route::post('','Vehiculo\VehiculoController@asignacionCaracteristicaVehiculoe');
               // Route::put('/{id}','Vehiculo\VehiculoController@updateAsignacionCaracteristicaVehiculo');
                Route::post('individual/','Vehiculo\VehiculoController@asignarCaracteristicaIndividual');

            });

        });



 ### Servios de  para creaciode costoServicios
        Route::group(['prefix'=>'servicios'],function (){
            #Servicios
            Route::post('','Proyecto\ServiciosController@store');
            Route::get('','Proyecto\ServiciosController@show');
            Route::get('/{nombre}','Proyecto\ServiciosController@filtre');
        });
### Costo Servicio
        Route::group(['prefix'=>'costoServicio'],function (){
             Route::post('/{idProyecto}','Proyecto\ProyectoController@addCostoSevicio');
        });
### Detalle Costo
        Route::group(['prefix'=>'detalleCosto'],function(){
            Route::post('','Proyecto\ProyectoController@addDetalleCosto');

            Route::get('', [ProyectoController::class, 'showTipocostoServicio'])->name('detalleCosto.show');
        });

###
        Route::prefix('consumo_pago_estimado')->group(function () {
            Route::get('', 'Proyecto\CostoPagoEstimadoController@getGastoEstimado');
        });

### Recorrido ubicacion
        Route::get('recorrido/accion', 'Proyecto\UbicacionRecorridoController@getAccionRecorrido');
        Route::get('recorrido/ubicacion', 'Proyecto\UbicacionRecorridoController@getUbicacionRecorrido');
        Route::post('ubicacion', 'Proyecto\UbicacionRecorridoController@storeUbicacion');
        Route::put('ubicacion/{id}', 'Proyecto\UbicacionRecorridoController@updateUbicacion');
        Route::delete('ubicacion/{id}', 'Proyecto\UbicacionRecorridoController@delete');
        Route::get('clacificacionUbicacion', 'Proyecto\UbicacionRecorridoController@clasificacionUbicacion');
    });

###Condiciones Economicas

    Route::get('condicionesEconomicas','Proyecto\CondicionesEconomicaController@showNombre');
});
