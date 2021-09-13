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
            // esperiencia
            //contactos
            $table->unsignedBigInteger('estado');

            $table->foreign('persona_id')->references('id')->on('personas')->cascadeOnDelete();
            $table->foreign('proveedor_id')->references('id')->on('proveedores');
            $table->foreign('estado')->references('id')->on('general_data');
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
