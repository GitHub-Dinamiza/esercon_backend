<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConductorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conductors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('persona_id')->unique();
            $table->unsignedBigInteger('proveedor_id');
            $table->timestamps();
            $table->softDeletes();
            //esperiencia
            //contactos
            $table->string('nombre_contacto')->nullable();
            $table->string('telefono_contacto')->nullable();
            $table->unsignedBigInteger('estado_id')->default(3);

            $table->foreign('persona_id')->on('personas')->references('id')->cascadeOnDelete();
            $table->foreign('proveedor_id')->on('proveedores')->references('id');
            $table->foreign('estado_id')->on('general_data')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conductors');
    }
}
