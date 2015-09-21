<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSelectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selections', function (Blueprint $table) {
           
            $table->increments('id');

            $table->integer('report_id')->unsigned()->index();
            $table->foreign('report_id')->references('id')->on('reports')->onDelete('cascade');

            $table->integer('prac_id')->unsigned()->index();
            $table->foreign('prac_id')->references('id')->on('practitioners')->onDelete('cascade');

            $table->integer('userid')->unsigned()->index();
            $table->foreign('userid')->references('id')->on('users')->onDelete('cascade');

            $table->string('notes');

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
        Schema::drop('selections');
    }
}
