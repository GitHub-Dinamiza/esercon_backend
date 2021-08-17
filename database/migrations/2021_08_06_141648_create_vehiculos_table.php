<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id();
            $table->string('placa',10)->unique();
            $table->unsignedBigInteger('tipo_vehiculo_id');

            $table->integer('capacidad_volco_m3')->nullable();
            $table->boolean('tiene_zorro');
            $table->float('capacidad_zorro')->nullable();
            $table->unsignedBigInteger('proveedor_id');
            $table->string('propietario')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('tipo_vehiculo_id')->references('id')->on('tipo_vehiculo');
            $table->foreign('proveedor_id')->references('id')->on('proveedores');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehiculos');
    }
}
