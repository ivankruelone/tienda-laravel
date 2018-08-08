<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sku', 20)->unique();
            $table->unsignedInteger('gender_id');
            $table->unsignedInteger('category_id');
            $table->string('description', 255);
            $table->string('slug', 1024);
            $table->unsignedDecimal('cost', 8, 2);
            $table->unsignedDecimal('price', 8, 2);
            $table->string('image', 255);
            $table->boolean('status')->default('1');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('gender_id')->references('id')->on('genders');
            $table->foreign('category_id')->references('id')->on('categories');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('items');
        Schema::enableForeignKeyConstraints();
    }
}
