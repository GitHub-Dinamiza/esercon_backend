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
            $table->unsignedBigInteger('tipo_vehiculo');
            $table->integer('capacidad_volco_m3')->nullable();
            $table->boolean('tiene_zorro');
            $table->float('capaidad_zorro')->nullable();
            $table->unsignedBigInteger('proveedor_id_m3');
            $table->string('Propietario');
            $table->timestamps();
            $table->softDeletes();
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
