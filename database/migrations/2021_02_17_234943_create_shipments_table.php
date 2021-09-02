<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_item_id')->foreign('id')->on('order_items')->onDelete('cascade');
            $table->string('order_id')->foreign('id')->on('orders')->onDelete('cascade');
            $table->string('type');
            $table->boolean('active')->default(0);
            $table->string('courier_name');
            $table->string('tracking_id');
            $table->string('shiprocket_order_id')->nullable();
            $table->string('shipment_id')->nullable();
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
        Schema::dropIfExists('shipments');
    }
}
