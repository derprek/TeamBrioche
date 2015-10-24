<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
           
            $table->increments('id');

            $table->integer('conv_id')->unsigned()->index();
            $table->foreign('conv_id')->references('id')->on('conversations');

            $table->string('sender_email');
            $table->string('receiver_email');

            $table->string('title');
            $table->string('content');
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
         Schema::drop('messages');
    }
}
