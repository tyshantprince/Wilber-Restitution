<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('county_id');
            $table->string('contact_name');
            $table->string('phone');
            $table->string('ext');
            $table->string('address1');
            $table->string('address2');
            $table->string('city');
            $table->string('zip');
            $table->string('fax');
            $table->string('email');
            $table->string('website');
            $table->string('fee');
            $table->text('notes');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');

    }
}
