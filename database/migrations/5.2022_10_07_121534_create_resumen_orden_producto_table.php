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
        Schema::create('resumen_orden_productos', function (Blueprint $table) {
            $table->id();

            $table->integer('cantidad');

            $table->unsignedBigInteger('producto_id');

            $table->unsignedBigInteger('resumen_orden_id');

            $table->foreign('producto_id')->references('id')->on('productos');


            $table->foreign('resumen_orden_id')->references('id')->on('resumen_ordens');


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
        Schema::dropIfExists('resumen_orden_producto');
    }
};
