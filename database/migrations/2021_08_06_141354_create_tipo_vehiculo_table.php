<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoVehiculoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_vehiculo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('marca_id');

            $table->string('modelo');
            $table->integer('anio_fabricacion');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('marca_id')->references('id')->on('general_data');
            $table->unique(['marca_id','modelo']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipo_vehiculo');
    }
}
