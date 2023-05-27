<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestServiceQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guest_service_questions', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();
            $table->text('question');
            $table->text('image')->nullable();
            $table->integer('sort_number')->nullable();
            $table->tinyInteger('is_active')->nullable();
            $table->bigInteger('gs_answer_option_id')->nullable();
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
        Schema::dropIfExists('guest_service_questions');
    }
}
