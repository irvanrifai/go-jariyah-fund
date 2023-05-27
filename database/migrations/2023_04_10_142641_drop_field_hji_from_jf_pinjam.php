<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropFieldHjiFromJfPinjam extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jf_pinjam', function (Blueprint $table) {
            $table->dropColumn('accepted_hji_1_at');
            $table->dropColumn('accepted_hji_2_at');
            $table->dropColumn('accepted_hji_1_user_agent');
            $table->dropColumn('accepted_hji_2_user_agent');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jf_pinjam', function (Blueprint $table) {
            $table->dateTime('accepted_hji_1_at')->nullable();
            $table->dateTime('accepted_hji_2_at')->nullable();
            $table->text('accepted_hji_1_user_agent')->nullable();
            $table->text('accepted_hji_2_user_agent')->nullable();
        });
    }
}
