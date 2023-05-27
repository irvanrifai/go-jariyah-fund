<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sarans', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->autoIncrement();
            $table->string('name', 250);
            $table->string('telp', 30);
            $table->string('email', 250);
            $table->string('subject', 250);
            $table->text('text')->nullable();
            $table->enum('status', ['draft', 'read', 'followup']);
            $table->text('user_agent')->nullable()->default(NULL);
            $table->timestamp('created_at')->nullable()->default(NULL);
            $table->bigInteger('created_by')->nullable();
            $table->timestamp('updated_at')->nullable()->default(NULL);
            $table->bigInteger('update_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sarans');
    }
}
