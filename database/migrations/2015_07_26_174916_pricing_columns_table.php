<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PricingColumnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pricing_columns', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('catalog_id');
            $table->string('name');
            $table->string('description');

            $table->decimal('min_sum');
            $table->decimal('max_sum');
            $table->boolean('min_sum_inclusive');
            $table->boolean('max_sum_inclusive');

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
        Schema::drop('pricing_columns');
    }
}
