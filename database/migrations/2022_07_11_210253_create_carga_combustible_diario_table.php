<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCargaCombustibleDiarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carga_combustible_diario', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vehiculo_id');
            $table->unsignedBigInteger('conductor_id');

            $table->unsignedBigInteger('proveedor_servicio_id');
            $table->dateTime('fecha_registro');
            // falta estacionde servicio id  que esta relacionada con  proyecto costo servicio
            //falta dia y hora
            $table->unsignedBigInteger('tipo_combustible');
            $table->float('valor_galon');
            $table->float('total_galon');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('vehiculo_id')->on('vehiculos')->references('id');
            $table->foreign('conductor_id')->on('conductors')->references('id');
            $table->foreign('user_id')->on('users')->references('id');
            $table->foreign('proveedor_servicio_id')->on('proyecto_costo_servicio')->references('id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carga_combustible_diario');
    }
}
