<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbApprovalPinjamByNazhir extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jf_pinjam_approval_by_nazhir', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pinjam_id');
            $table->bigInteger('nazhir_id');
            $table->dateTime('accepted_at')->nullable();
            $table->enum('status', ['draft', 'accepted', 'reject']);
            $table->text('note')->nullable();
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
        Schema::dropIfExists('jf_pinjam_approval_by_nazhir');
    }
}
