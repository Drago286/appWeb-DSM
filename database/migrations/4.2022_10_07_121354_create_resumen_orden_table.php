<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resumen_ordens', function (Blueprint $table) {
            $table->id();

            $table->integer('montoTotal');

            $table->unsignedBigInteger('mesa_id');

            $table->enum('estado', ['PENDIENTE', 'EN PREPARACION', 'FINALIZADA']);


            $table->foreign('mesa_id')->references('id')->on('mesas');

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
        Schema::dropIfExists('resumen_orden');
    }
};
