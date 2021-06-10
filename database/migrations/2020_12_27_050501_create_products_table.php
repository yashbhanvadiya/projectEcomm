<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id');
            $table->string('product_category');
            $table->string('product_subcategory');
            $table->string('product_extracategory');
            $table->string('product_type');
            $table->string('product_brand');
            $table->string('product_name');
            $table->string('product_price');
            $table->string('product_description');
            $table->string('product_color');
            $table->string('product_size');
            $table->string('product_image');
            $table->string('product_mimage');
            $table->string('product_status');
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
        Schema::dropIfExists('products');
    }
}
