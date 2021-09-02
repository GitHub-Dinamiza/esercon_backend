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
            //$table->unsignedBigInteger('tipo_documento_id');
            $table->string('numero_documento');
            //$table->unsignedBigInteger('ciudad_residencia_id');
            $table->string('direccion');
            $table->string('telefono');
            $table->string('email');
            $table->string('estado_civil');
            //$table->unsignedBigInteger('tipo_sangle_id');
            //$table->unsignedBigInteger('eps_id')->nullable();
            //$table->unsignedBigInteger('url_id')->nullable();
            $table->timestamps();
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
