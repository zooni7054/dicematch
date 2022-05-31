<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('career_track_id')->nullable()->constrained('career_tracks')->onDelete('cascade');
            $table->foreignId('user_role_id')->default(1)->constrained('user_roles')->onDelete('cascade');
            $table->string('profile_id')->unique();
            $table->string('profile_slug')->unique()->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->text('about')->nullable();
            $table->string('phone')->nullable();
            $table->string('cnic')->nullable();
            $table->date('dob')->nullable();
            $table->enum('gender', ['Male', 'Female', 'Other'])->nullable();
            $table->string('address')->nullable();
            $table->foreignId('city_id')->nullable()->constrained('cities')->onDelete('cascade');
            $table->string('profile_headline')->nullable();
            $table->integer('wizard')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('github')->nullable();
            $table->integer('completion_progress')->nullable();
            $table->enum('status', ['active', 'disabled', 'suspended'])->default('active');
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
        Schema::dropIfExists('users');
    }
}
