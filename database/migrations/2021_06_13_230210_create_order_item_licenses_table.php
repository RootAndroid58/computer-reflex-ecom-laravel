<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemLicensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_item_licenses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_item_id')->foreign('id')->on('order_items')->onDelete('cascade');
            $table->bigInteger('product_license_id')->foreign('id')->on('product_licenses')->onDelete('cascade');
            $table->dateTime('delivery_date')->nullable();
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
        Schema::dropIfExists('order_item_licenses');
    }
}
