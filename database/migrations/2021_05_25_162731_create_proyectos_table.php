<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProyectosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->string('nombre');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->unsignedBigInteger('municipio_inicio_id');
            $table->string('ubicacion_inicial');
            $table->unsignedBigInteger('municipio_final_id');
            $table->string('ubicacion_final');
            $table->integer('horas_laboral_dia');
            $table->integer('temperatura');
            $table->boolean('estado')->default(true);
            $table->unsignedBigInteger('user_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('municipio_inicio_id')->references('id')->on('municipios');
            $table->foreign('municipio_final_id')->references('id')->on('municipios');
            $table->foreign('user_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proyectos');
    }
}
