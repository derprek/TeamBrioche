<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_report', function(Blueprint $table)
            {
                $table->increments('prid');
                $table->integer('report_id')->unsigned()->index();
                $table->foreign('report_id')->references('id')->on('reports')->onDelete('cascade');

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
        Schema::drop('product_report');
    }
}
