<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('skill_id')->nullable()->constrained('skills')->onDelete('cascade');
            $table->string('level')->nullable();
            $table->text('instructions')->nullable();
            $table->time('allowed_time')->nullable();
            $table->integer('next_attempt_duration')->nullable();
            $table->integer('is_show_result')->default(0);
            $table->integer('sort_order')->default(1);
            $table->enum('status', ['active', 'disabled'])->default('active');
            $table->softDeletes();
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
        Schema::dropIfExists('quizzes');
    }
}
