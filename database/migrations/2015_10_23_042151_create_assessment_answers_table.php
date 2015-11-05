<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssessmentAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessment_answers', function(Blueprint $table)
            {
                $table->increments('id');
                $table->integer('version_id')->unsigned()->index();

                $table->integer('assessment_id')->unsigned()->index();
                $table->foreign('assessment_id')->references('id')->on('assessments')->onDelete('cascade');

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
        Schema::drop('assessment_answers');
    }
}
