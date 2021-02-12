<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->foreign('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('addresses');
    }
}
