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
            $table->string('modelo',70);
            $table->integer('anio',4);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('marca_id')->references('id')->on('general_data');
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
