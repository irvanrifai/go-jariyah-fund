<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDetailDataUsahaAnggota extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jf_detail_data_usaha_anggota', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('duta_wakaf_id')->nullable();
            $table->text('nama_owner')->nullable();
            $table->text('nama_umkm')->nullable();
            $table->text('alamat_umkm')->nullable();
            $table->string('no_telepon')->nullable();
            $table->string('jenis_usaha')->nullable();
            $table->integer('omset_usaha')->nullable();
            $table->string('akta_pendirian_usaha')->nullable();
            $table->string('npwp')->nullable();
            $table->string('nib')->nullable();
            $table->string('pirt')->nullable();
            $table->string('sertif_halal')->nullable();
            $table->string('laporan_keuangan_usaha')->nullable();
            $table->integer('total_dana_usaha')->nullable();
            $table->integer('dana_sekarang')->nullable();
            $table->integer('dana_pinjaman_dibutuhkan')->nullable();
            $table->text('rincian_kebutuhan_dana')->nullable();
            $table->integer('lama_pengembalian_pinjaman')->nullable();
            $table->integer('jumlah_pengembalian_per_bulan')->nullable();
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
        Schema::dropIfExists('jf_detail_data_usaha_anggota');
    }
}
