<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecorridoProyectosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recorrido_proyectos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->string('direccion');
            $table->unsignedBigInteger('municipio_id');
            $table->unsignedBigInteger('clasificacion_id');
            $table->unsignedBigInteger('user_id');

            $table->foreign('municipio_id')
                  ->on('municipios')
                  ->references('id');

            $table->foreign('clasificacion_id')
                  ->on('clasificacion_ubicacions')
                  ->references('id');

            $table->foreign('user_id')
                  ->on('users')
                  ->references('id');


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
        Schema::dropIfExists('recorrido_proyectos');
    }
}
