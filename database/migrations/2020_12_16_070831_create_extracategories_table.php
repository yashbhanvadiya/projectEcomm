<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtracategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extracategories', function (Blueprint $table) {
            $table->id('extracategory_id');
            $table->string('extra_cat_id');
            $table->string('extra_sub_id');
            $table->string('extracategory_name');
            $table->integer('extracategory_status');
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
        Schema::dropIfExists('extracategories');
    }
}
