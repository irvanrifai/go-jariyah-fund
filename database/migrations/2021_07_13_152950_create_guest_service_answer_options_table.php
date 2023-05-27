<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestServiceAnswerOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guest_service_answer_options', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();
            $table->bigInteger('gs_question_id');
            $table->text('text');
            $table->text('image')->nullable();
            $table->integer('sort_number');
            $table->tinyInteger('is_true');
            $table->tinyInteger('is_active')->nullable();
            $table->bigInteger('created_by');
            $table->bigInteger('updated_by')->nullable();
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
        Schema::dropIfExists('guest_service_answer_options');
    }
}
