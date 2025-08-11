<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact__contacts', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('contact_code');
            $table->string('contact_name');
            $table->string('phone_number');
            $table->string('email');
            $table->text('contact_title');
            $table->text('note')->nullable();
            $table->integer('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('contact__categories')->onDelete('cascade');
            $table->string('status');
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
        Schema::table('contact__contacts', function (Blueprint $table) {
            $table->dropForeign('type_id');
        });
        Schema::dropIfExists('contact__contacts');
    }
}
