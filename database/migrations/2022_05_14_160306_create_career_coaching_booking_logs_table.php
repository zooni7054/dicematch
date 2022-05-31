<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCareerCoachingBookingLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('career_coaching_booking_logs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('career_coaching_booking_id')->nullable()->unsigned();
            $table->dateTime('booking_start')->nullable();
            $table->dateTime('booking_end')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('career_coaching_booking_id', 'l_career_coaching_booking_id_foreign')->references('id')->on('career_coaching_bookings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('career_coaching_booking_logs');
    }
}
