<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsShowStatisticToGuestServiceQuestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('guest_service_questions', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_sort_number')->after('gs_answer_option_id')->nullable();
            $table->boolean('is_show_statistic')->default(true)->after('parent_sort_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('guest_service_questions', function (Blueprint $table) {
            $table->dropColumn('parent_sort_number');
            $table->dropColumn('is_show_statistic');
        });
    }
}
