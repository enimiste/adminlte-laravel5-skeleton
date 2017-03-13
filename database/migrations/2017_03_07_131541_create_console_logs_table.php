<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsoleLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('console_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type', 20);
            $table->string('message');
            $table->string('loggable_type')->nullable();
            $table->string('loggable_id')->nullable();
            $table->string('by_user');
            $table->timestamps();

            $table->index('loggable_type');
            $table->index('loggable_id');
            $table->index('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('console_logs');
    }
}
