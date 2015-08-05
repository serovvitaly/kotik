<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('catalog_id');
            $table->string('code');
            $table->string('article');
            $table->string('name');
            $table->string('description', 5000);
            $table->integer('purchase_template_id');
            $table->string('source_url', 255);
            
            $table->string('brand', 100);
            $table->string('country_name', 100);
            $table->integer('weight');
            $table->string('measure_unit', 10);
            $table->integer('in_stock');
            $table->integer('min_party');
            
            $table->double('price_1');
            $table->double('price_2');
            $table->double('price_3');
            $table->double('price_4');
            
            $table->integer('category_id');
            $table->string('product_line', 100);

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
        Schema::drop('products');
    }
}
