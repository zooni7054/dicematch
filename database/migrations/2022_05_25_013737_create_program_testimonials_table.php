<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramTestimonialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_testimonials', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('program_id');
            $table->text('title');
            $table->text('subtitle')->nullable();
            $table->text('type');
            $table->text('message')->nullable();
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
        Schema::dropIfExists('program_testimonials');
    }
}
