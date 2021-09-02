<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->foreign('id')->on('orders')->onDelete('cascade');
            $table->bigInteger('product_id')->foreign('id')->on('products')->onDelete('cascade');
            $table->bigInteger('qty');
            $table->string('unit_price');
            $table->string('unit_mrp');
            $table->string('total_price');
            $table->date('delivered_on')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('order_items');
    }
}
