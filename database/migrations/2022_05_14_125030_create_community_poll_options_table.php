<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommunityPollOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('community_poll_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('community_poll_id')->nullable()->constrained('community_polls')->onDelete('cascade');
            $table->string('title');
            $table->string('status')->nullable();
            $table->integer('counts')->default(0);
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
        Schema::dropIfExists('community_poll_options');
    }
}
