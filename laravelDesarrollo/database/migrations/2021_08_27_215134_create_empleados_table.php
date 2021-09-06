<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->integer('id_empleado')->primary();
            $table->string('codigo', 9)->nullable();
            $table->string('nombres', 60)->nullable();
            $table->string('apellidos', 60)->nullable();
            $table->string('direccion', 100)->nullable();
            $table->string('telefono', 8)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->smallInteger('id_puesto')->nullable();
            $table->foreign('id_puesto', 'fk')->references('id_puesto')->on('puestos')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleados');
    }
}
