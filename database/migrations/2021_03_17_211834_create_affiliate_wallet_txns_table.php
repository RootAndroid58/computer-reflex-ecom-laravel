<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAffiliateWalletTxnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affiliate_wallet_txns', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->foreign('id')->on('users')->onDelete('cascade');
            $table->string('type');
            $table->longText('description');
            $table->bigInteger('txn_amount');
            $table->bigInteger('ob');
            $table->bigInteger('cb');
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
        Schema::dropIfExists('affiliate_wallet_txns');
    }
}
