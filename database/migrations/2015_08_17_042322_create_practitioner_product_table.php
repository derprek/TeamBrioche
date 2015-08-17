<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePractitionerProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('practitioner_product', function(Blueprint $table)
            {
                $table->increments('prid');
                $table->integer('prac_id')->unsigned()->index();
                $table->foreign('prac_id')->references('id')->on('practitioners')->onDelete('cascade');

                $table->integer('product_id')->unsigned()->index();
                $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

                $table->timestamp('updated_on');

            }); //articles and tag
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('practitioner_product');
    }
}
