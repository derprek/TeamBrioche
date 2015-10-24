<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypologyAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('typology_answers', function(Blueprint $table)
            {
                $table->increments('id');

                $table->integer('typology_id')->unsigned()->index();
                $table->foreign('typology_id')->references('id')->on('typologies')->onDelete('cascade');

                $table->integer('question_id')->unsigned()->index();
                $table->foreign('question_id')->references('id')->on('questions');

                $table->text('answers');
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
        Schema::drop('typology_answers');
    }
}
