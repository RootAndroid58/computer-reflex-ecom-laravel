<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('banner_name')->unique();
            $table->string('banner_position')->nullable()->unique();
            $table->boolean('banner_status')->default(0);
            $table->string('banner_img');
            $table->string('banner_header');
            $table->string('banner_header_2');
            $table->string('banner_caption');
            $table->string('banner_btn_txt');
            $table->string('banner_btn_link');
            $table->string('banner_btn_color');
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
        Schema::dropIfExists('banners');
    }
}
