<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product__products', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('product__categories')->onDelete('cascade');
            $table->string('code');
            $table->double('rating')->unsigned()->default(0);
            $table->tinyInteger('product_status')->unsigned()->default(1);
            $table->boolean('show_homepage')->default(false);
            $table->boolean('is_promotion')->default(false);
            $table->double('price')->default(0);
            $table->double('price_sale')->default(0);
            $table->boolean('status')->default(true);
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
        Schema::table('product__products', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
        });
        Schema::dropIfExists('product__products');
    }
}
