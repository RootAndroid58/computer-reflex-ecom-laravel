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
            $table->bigIncrements('id');
            $table->string('product_name');
            $table->longText('product_description');
            $table->string('product_brand');
            $table->bigInteger('product_mrp');
            $table->bigInteger('product_price');
            $table->bigInteger('product_stock')->default(0);
            $table->boolean('product_status')->default(0);
            $table->boolean('product_published')->default(0);
            $table->bigInteger('product_category_id')->foreign('id')->on('categories');
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
        Schema::dropIfExists('products');
    }
}
