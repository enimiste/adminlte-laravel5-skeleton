<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportedFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imported_files', function (Blueprint $table) {
            $table->string('id');
            $table->string('client_file_name');
            $table->unsignedInteger('accumulated_nbr_lines')->default(0);
            $table->unsignedInteger('accumulated_nbr_processed_lines')->default(0);
            $table->string('state', 100);
            $table->string('importable_type', 50);
            $table->timestamps();

            $table->index('state');
            $table->unique('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imported_files');
    }
}
