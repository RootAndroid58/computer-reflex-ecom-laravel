<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAffiliateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affiliate_order_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('associate_id')->foreign('id')->on('order_items')->onDelete('cascade');
            $table->bigInteger('order_item_id')->foreign('id')->on('order_items')->onDelete('cascade');
            $table->bigInteger('comission');
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
        Schema::dropIfExists('affiliate_order_items');
    }
}
