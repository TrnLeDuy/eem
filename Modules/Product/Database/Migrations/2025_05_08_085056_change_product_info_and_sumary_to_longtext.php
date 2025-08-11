<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeProductInfoAndSumaryToLongtext extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product__product_translations', function (Blueprint $table) {
            $table->longText('product_info')->nullable()->change();
            $table->longText('sumary')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product__product_translations', function (Blueprint $table) {
            $table->text('product_info')->nullable()->change();
            $table->text('sumary')->nullable()->change();
        });
    }
}