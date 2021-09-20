<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProveedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedores', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('razon_social')->nullable();

            $table->string('primer_nombre')->nullable();
            $table->string('primer_apellido')->nullable();
            $table->string('segundo_nombre')->nullable();
            $table->string('segundo_apellido')->nullable();
            $table->boolean('tipo_proveedor');
            $table->string('direccion');
            $table->string('telefono');
            $table->string('email');
            $table->unsignedBigInteger('municipio_id');
            $table->unsignedBigInteger('user_id');
            $table->softDeletes();
            $table->timestamps();

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
        Schema::dropIfExists('proveedores');
    }
}
