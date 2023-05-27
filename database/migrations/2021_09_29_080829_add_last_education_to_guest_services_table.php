<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLastEducationToGuestServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('guest_services', function (Blueprint $table) {
            $table->enum('last_education', ['sd', 'smp', 'sma', 'diploma', 's1', 's2', 's3'])->after('instansi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('guest_services', function (Blueprint $table) {
            $table->dropColumn('last_education');
        });
    }
}
