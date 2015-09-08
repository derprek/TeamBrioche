<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_report', function(Blueprint $table)
            {
                $table->increments('rqid');
                $table->integer('report_id')->unsigned()->index();
                $table->foreign('report_id')->references('id')->on('reports');

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
        Schema::drop('question_report');
    }
}
