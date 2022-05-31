<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizResultSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_result_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_result_id')->nullable()->constrained('quiz_results')->onDelete('cascade');
            $table->foreignId('quiz_question_id')->nullable()->constrained('quiz_questions')->onDelete('cascade');
            $table->foreignId('quiz_question_option_id')->nullable()->constrained('quiz_question_options')->onDelete('cascade');
            $table->boolean('is_correct')->default(false);
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
        Schema::dropIfExists('quiz_result_submissions');
    }
}
