<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id('product_id');
            $table->foreign('category_id')->references('category_id')->on('category')->onDelete('cascade');
            $table->foreign('sub_cat_id')->references('sub_cat_id')->on('sub_category')->onDelete('cascade');
            $table->foreign('brand_id')->references('brand_id')->on('brand')->onDelete('cascade');
            // $table->integer('category_id');
            // $table->integer('brand_id');
            $table->string('product_name');
            $table->string('product_short_description');
            $table->string('product_long_description');
            $table->string('product_price');
            $table->string('product_image');
            $table->string('product_size');
            $table->string('product_color');
            $table->integer('publication_status');
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
        Schema::dropIfExists('product');
    }
}
