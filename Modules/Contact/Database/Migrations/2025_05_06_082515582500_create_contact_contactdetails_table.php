<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactContactDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact__contactdetails', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->text('messages')->nullable();
            $table->string('assembly_address')->nullable();
            $table->double('monthly_consumption_kwh')->unsigned()->default(0);
            $table->double('avg_monthly_cost_vnd')->unsigned()->default(0);
            $table->double('financial_capacity_kw')->unsigned()->default(0);
            $table->double('avl_roof_area_m2')->unsigned()->default(0);
            $table->integer('power_phase_count')->unsigned()->default(0);
            $table->integer('contact_id')->unsigned();
            $table->foreign('contact_id')->references('id')->on('contact__contacts')->onDelete('cascade');
            $table->integer('product_id')->unsigned()->nullable();
            $table->foreign('product_id')->references('id')->on('product__products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contact__contactdetails', function (Blueprint $table) {
            $table->dropForeign(['contact_id', 'product_id']);
        });
        Schema::dropIfExists('contact__contactdetails');
    }
}
