<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestServiceReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guest_service_reports', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->bigInteger('gs_id')->default(NULL);
            $table->bigInteger('gs_question_id')->default(NULL);
            $table->bigInteger('gs_answer_option_id')->default(NULL);
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
        Schema::dropIfExists('guest_service_reports');
    }
}
