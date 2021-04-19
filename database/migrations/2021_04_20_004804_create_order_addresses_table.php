<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_addresses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id')->foreign('id')->on('orders')->onDelete('cascade');
            $table->string('name');
            $table->string('house_no');
            $table->string('locality');
            $table->string('city');
            $table->string('district');
            $table->string('state');
            $table->string('pin_code');
            $table->string('mobile');
            $table->string('alt_mobile')->nullable();
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
        Schema::dropIfExists('order_addresses');
    }
}
