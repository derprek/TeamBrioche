<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManagerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('managers', function(Blueprint $table)
            {
                $table->increments('rq_id');
                $table->integer('question_id')->unsigned()->index();
                 $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');

                $table->integer('id')->unsigned()->index();
            
                $table->text('answers')->nullable();
                $table->timestamps();

            }); //articles and tag
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('managers');
    }
}
