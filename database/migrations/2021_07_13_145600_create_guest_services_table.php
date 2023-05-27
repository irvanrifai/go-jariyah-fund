<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guest_services', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();
            $table->string('fullname', 300)->nullable();
            $table->string('email', 300)->nullable();
            $table->string('telp', 30)->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->tinyInteger('old')->nullable();
            $table->text('user_agent')->nullable();
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
        Schema::dropIfExists('guest_services');
    }
}
