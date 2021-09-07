<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportTicketMsgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_ticket_msgs', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_id')->foreign('id')->on('support_tickets')->onDelete('cascade');
            $table->bigInteger('user_id')->foreign('id')->on('users')->onDelete('cascade');
            $table->string('type');
            $table->longText('msg');
            $table->longText('attachments');
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
        Schema::dropIfExists('support_ticket_msgs');
    }
}
