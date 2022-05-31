<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCareerCoachingBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('career_coaching_bookings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable()->unsigned();
            $table->bigInteger('career_coach_id')->nullable()->unsigned();
            $table->bigInteger('career_coaching_type_id')->nullable()->unsigned();
            $table->bigInteger('product_package_id')->nullable()->unsigned();
            $table->dateTime('booking_start')->nullable();
            $table->dateTime('booking_end')->nullable();
            $table->dateTime('actual_start')->nullable();
            $table->dateTime('actual_end')->nullable();
            $table->string('recording_link')->nullable();
            $table->text('message')->nullable();
            $table->text('coach_remarks')->nullable();
            $table->text('client_remarks')->nullable();
            $table->bigInteger('ratting')->default(0);
            $table->boolean('is_paid')->default(false);
            $table->enum('status', ['pending', 'accepted', 'rejected', 'expired','cancelled','completed'])->default('pending');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id', 'user_id_foreign')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('career_coach_id', 'career_coach_id_foreign')->references('id')->on('career_coaches')->onDelete('cascade');
            $table->foreign('career_coaching_type_id', 'career_coaching_type_id_foreign')->references('id')->on('career_coaching_types')->onDelete('cascade');
            $table->foreign('product_package_id', 'product_package_id_foreign')->references('id')->on('product_packages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('career_coaching_bookings');
    }
}
