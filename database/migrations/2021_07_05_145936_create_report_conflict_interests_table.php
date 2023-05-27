<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportConflictInterestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_conflict_interests', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();
            $table->string('fullname', 250);
            $table->string('reported_fullname', 250);
            $table->string('reported_position', 250);
            $table->string('telp', 50);
            $table->string('email', 150);
            $table->enum('type', ['afiliasi','gratifikasi','kerja_tambahan','orang_dalam','pengadaan_barang','tuntutan_keluarga','kedudukan_ganda','intervensi_jabatan','rangkap_jabatan']);
            $table->text('text');
            $table->enum('status', ['draft','followup','done'])->default('draft');
            $table->date('date');
            $table->text('location');

            $table->bigInteger('unit_id');
            $table->foreign('unit_id')->references('id')->on('units');

            $table->text('note')->nullable();
            $table->text('file')->nullable();
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
        Schema::dropIfExists('report_conflict_interests');
    }
}
