<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTrackingPinjaman extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jf_tracking_pinjaman_anggota', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pinjam_id');
            $table->dateTime('step_1_complete_at')->nullable();
            $table->dateTime('step_2_complete_at')->nullable();
            $table->dateTime('step_3_complete_at')->nullable();
            $table->dateTime('step_4_complete_at')->nullable();
            $table->dateTime('step_5_complete_at')->nullable();
            $table->dateTime('step_6_complete_at')->nullable();
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
        Schema::dropIfExists('jf_tracking_pinjaman_anggota');
    }
}
