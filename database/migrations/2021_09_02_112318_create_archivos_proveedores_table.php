<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchivosProveedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archivos_proveedores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->unsignedBigInteger('proveedor_id');
            $table->unsignedBigInteger('tipo_archivo_id');
            $table->string('ruta');
            $table->string('extension')->nullable();
            $table->float('tamanio');
            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')->on('users')->references('id');
            $table->foreign('proveedor_id')->on('proveedores')->references('id');
            $table->foreign('tipo_archivo_id')->on('general_data')->references('id');


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
        Schema::dropIfExists('archivos_proveedores');
    }
}
