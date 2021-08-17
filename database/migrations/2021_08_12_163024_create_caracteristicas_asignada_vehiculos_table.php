                                                                                  <?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaracteristicasAsignadaVehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caracteristicas_asignada_vehiculos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vehiculo_id');
            $table->unsignedBigInteger('caracteristica_vehiculo_id');
            $table->string('estado');
            $table->text('detalle')->nullable();
            $table->foreign('vehiculo_id')->references('id')->on('vehiculos');
            $table->foreign('caracteristica_vehiculo_id')->references('id')->on('carecteristica_vehiculos');
            $table->unique(['vehiculo_id','caracteristica_vehiculo_id']);
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
        Schema::dropIfExists('caracteristicas_asignada_vehiculos');
    }
}
