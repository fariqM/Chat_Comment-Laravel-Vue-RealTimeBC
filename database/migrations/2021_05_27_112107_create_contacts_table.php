<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('contact_name', 100);
            $table->foreignId('owner_id');
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
            $table->boolean('ischatting');
            $table->text('last_message')->nullable();
            $table->time('lastmessage_time')->nullable();
            $table->boolean('isactive');
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
        Schema::dropIfExists('contacts');
    }
}
