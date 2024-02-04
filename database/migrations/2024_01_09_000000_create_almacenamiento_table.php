<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlmacenamientoTable extends Migration
{
    public function up()
    {
        Schema::create('almacenamiento', function (Blueprint $table) {
            $table->id('bodegaID');
            $table->string('direccion');
            $table->foreignId('proveedorID')->constrained('proveedores');
            $table->foreignId('productoID')->constrained('productos');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bodegas');
    }
}
