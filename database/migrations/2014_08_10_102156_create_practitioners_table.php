<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePractitionersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {     
        Schema::create('practitioners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fname');
            $table->string('sname');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('usertype');
            $table->boolean('verified');
            $table->rememberToken();
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
       Schema::drop('practitioners');
    }
}
