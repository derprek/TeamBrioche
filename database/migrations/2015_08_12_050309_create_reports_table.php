<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('reports', function (Blueprint $table) {
           
            $table->increments('id');

            $table->integer('userid')->unsigned()->index();
            $table->foreign('userid')->references('id')->on('users')->onDelete('cascade');

            $table->integer('step');
            $table->timestamp('date');
            $table->string('status');

            $table->integer('prac_id')->unsigned()->index();
            $table->foreign('prac_id')->references('id')->on('practitioners')->onDelete('cascade');

            $table->string('prac_notes');
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
        Schema::drop('reports');
    }
}
