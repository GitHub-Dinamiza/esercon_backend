<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConductorAsignadoVehiculoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conductor_asignado_vehiculo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vehiculo_id');
            $table->unsignedBigInteger('conductor_id');
            $table->text('comentario')->nullable();
            $table->boolean('state')->default(true);
            $table->timestamps();

            $table->foreign('vehiculo_id')
                ->references('id')
                ->on('vehiculos');
            $table->foreign('conductor_id')
                ->references('id')
                ->on('conductors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conductor_asignado_vehiculo');
    }
}
