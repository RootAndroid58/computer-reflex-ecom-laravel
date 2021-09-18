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
            $table->string('position')->nullable();
            $table->boolean('banner_status')->default(false);
            $table->string('banner_img');
            $table->string('banner_header')->nullable();
            $table->string('banner_header_2')->nullable();
            $table->string('banner_caption')->nullable();
            $table->string('banner_btn_txt')->nullable();
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
