<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_education', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('education_institute_id')->nullable()->constrained('education_institutes')->onDelete('cascade');
            $table->foreignId('education_field_id')->nullable()->constrained('education_fields')->onDelete('cascade');
            $table->foreignId('education_level_id')->nullable()->constrained('education_levels')->onDelete('cascade');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('qualification_name')->nullable();
            $table->string('is_currently_here')->nullable();
            $table->string('marks')->nullable();
            $table->text('social_activities')->nullable();
            $table->text('description')->nullable();
            $table->integer('sort_order')->default(1);
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
        Schema::dropIfExists('user_education');
    }
}
