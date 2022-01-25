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
            
            $table->string('product_number')->unique();
            $table->string('upc',13);
            $table->string('sku',13);
            $table->decimal('regular_price',10,2);
            $table->decimal('sale_price',10,2);
            $table->bigInteger('category_id');
            $table->bigInteger('department_id');
            $table->bigInteger('manufacturer_id');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            Schema::dropIfExists('products');
        });
    }
}
