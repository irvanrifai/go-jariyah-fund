<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldIsCompleteToTbJfPinjam extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jf_pinjam', function (Blueprint $table) {
            $table->integer('is_complete')->nullable();
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
            $table->dropColumn('is_complete');
        });
    }
}
