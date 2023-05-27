<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldNoteAdminApprovalAtToTbJfCicilan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jf_cicilan', function (Blueprint $table) {
            $table->text('note_admin')->nullable();
            $table->dateTime('approval_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jf_cicilan', function (Blueprint $table) {
            $table->dropColumn('note_admin');
            $table->dropColumn('approval_at');
        });
    }
}
