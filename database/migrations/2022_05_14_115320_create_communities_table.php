<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommunitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('communities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('career_track_id')->nullable()->constrained('career_tracks')->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('rules')->nullable();
            $table->text('ads_code')->nullable();
            $table->enum('status', ['active', 'disabled', 'archived'])->default('active');
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
        Schema::dropIfExists('communities');
    }
}
