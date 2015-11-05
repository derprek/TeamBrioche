<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluationsAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluation_answers', function(Blueprint $table)
            {
                $table->increments('id');
            
                $table->integer('evaluation_id')->unsigned()->index();
                $table->foreign('evaluation_id')->references('id')->on('evaluations')->onDelete('cascade');

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
        Schema::drop('evaluation_answers');
    }
}
