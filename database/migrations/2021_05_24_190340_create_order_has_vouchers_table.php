<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderHasVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_has_vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->foreign('id')->on('orders')->onDelete('cascade')->unique();
            $table->bigInteger('voucher_id')->foreign('id')->on('vouchers')->onDelete('cascade');
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
        Schema::dropIfExists('order_has_vouchers');
    }
}
