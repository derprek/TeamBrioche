<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionSelectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('question_selection', function(Blueprint $table)
            {
                $table->increments('qsid');
                $table->integer('selection_id')->unsigned()->index();
                $table->foreign('selection_id')->references('id')->on('selections')->onDelete('cascade');

                $table->integer('question_id')->unsigned()->index();
                $table->foreign('question_id')->references('id')->on('questions');

                $table->text('answers');
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
        Schema::drop('question_selection');
    }
}
