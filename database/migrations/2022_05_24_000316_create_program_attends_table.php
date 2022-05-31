<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramAttendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_attends', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('program_id');
            $table->text('content');
            $table->integer('status');
            $table->integer('created_by')->nullable()->default(0);
            $table->dateTime('created_at')->useCurrent();
            $table->integer('updated_by')->nullable()->default(0);
            $table->dateTime('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('program_attends');
    }
}
