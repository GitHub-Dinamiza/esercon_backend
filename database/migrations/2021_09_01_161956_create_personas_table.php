<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->string('primer_nombre');
            $table->string('segundo_nombre')->nullable();
            $table->string('primer_apellido');
            $table->string('segundo_apellido')->nullable();
            $table->unsignedBigInteger('tipo_documento_id');
            $table->string('numero_documento')->unique();
            $table->unsignedBigInteger('ciudad_residencia_id');
            $table->string('direccion');
            $table->string('telefono');
            $table->string('email')->unique();
            $table->string('estado_civil');
            $table->unsignedBigInteger('tipo_sangle_id')->nullable();
            $table->unsignedBigInteger('eps_id')->nullable();
            $table->unsignedBigInteger('arl_id')->nullable();
            $table->boolean('estado')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('tipo_sangle_id')->on('general_data')->references('id');
            $table->foreign('eps_id')->on('general_data')->references('id');
            $table->foreign('arl_id')->on('general_data')->references('id');
            $table->foreign('tipo_documento_id')->on('tipos_documentos')->references('id');
            $table->foreign('ciudad_residencia_id')->on('municipios')->references('id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personas');
    }
}
