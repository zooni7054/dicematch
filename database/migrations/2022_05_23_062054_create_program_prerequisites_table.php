<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramPrerequisitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_prerequisites', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('program_id');
            $table->text('other_program_ids')->nullable();
            $table->text('degree_levels')->nullable();
            $table->text('field_of_studies')->nullable();
            $table->text('prior_job_experience')->nullable();
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
        Schema::dropIfExists('program_prerequisites');
    }
}
