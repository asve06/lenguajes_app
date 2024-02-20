<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id('productoid');
            $table->string('nombre');
            $table->decimal('precio', 10, 2);
            $table->string('descripcion');
            $table->integer('existencia_actual');
            $table->foreignId('categoriaID')->constrained('categorias', 'categoriaID');
            $table->foreignId('proveedorID')->constrained('proveedors', 'proveedorID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
