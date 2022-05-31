<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCareerCoachingBookingFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('career_coaching_booking_feedback', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable()->unsigned();
            $table->bigInteger('career_coaching_booking_id')->nullable()->unsigned();
            $table->text('comments')->nullable();
            $table->integer('rating')->default(0)->unsigned();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id', 'f_user_id_foreign')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('career_coaching_booking_id', 'f_career_coaching_booking_id_foreign')->references('id')->on('career_coaching_bookings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('career_coaching_booking_feedback');
    }
}
