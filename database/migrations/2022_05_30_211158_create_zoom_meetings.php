<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZoomMeetings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zoom_meetings', function (Blueprint $table) {
            $table->id();
            $table->string('table_name')->nullable();
            $table->text('topic')->nullable();
            $table->string('meeting_id')->nullable();
            $table->string('uuid')->nullable();
            $table->string('host_id')->nullable();
            $table->string('host_email')->nullable();
            $table->string('password')->nullable();
            $table->text('response_json')->nullable();
            $table->bigInteger('table_id')->nullable()->unsigned();
            $table->text('start_link')->nullable();
            $table->text('join_link')->nullable();
            $table->enum('status', ['active', 'expired'])->default('active');
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
        Schema::dropIfExists('zoom_meetings');
    }
}
