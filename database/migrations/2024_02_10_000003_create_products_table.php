<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('productID');
            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->string('description');
            $table->integer('current_stock');
            $table->foreignId('labelID')->constrained('labels', 'labelID');
            $table->foreignId('originID')->constrained('origins', 'originID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
