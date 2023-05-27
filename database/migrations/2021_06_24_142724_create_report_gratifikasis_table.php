<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportGratifikasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_gratifikasis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fullname', 250);
            $table->string('email', 250);
            $table->string('telp', 50);
            $table->enum('status', ['draft', 'done', 'followup']);
            $table->string('position', 300);
            $table->date('date');
            $table->tinyInteger('is_accept');
            $table->string('from_company', 300)->nullable();
            $table->text('from_type');
            $table->biginteger('from_nominal_estimate')->nullable();
            $table->text('note_forward')->nullable();
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
        Schema::dropIfExists('report_gratifikasis');
    }
}
