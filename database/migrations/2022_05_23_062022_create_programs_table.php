<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->integer('id', true);
            $table->text('training_type')->comment('instructor led, self-paced, private tuition, corporate training');
            $table->integer('class_id');
            $table->text('title');
            $table->text('code');
            $table->integer('track_id');
            $table->integer('sub_track_id');
            $table->integer('duration')->comment('in hours');
            $table->text('description')->nullable();
            $table->text('brochure')->nullable();
            $table->text('banner')->nullable();
            $table->text('promo_video')->nullable();
            $table->float('net_price', 10, 0)->nullable()->default(0);
            $table->float('gst_percent', 10, 0)->nullable()->default(0);
            $table->float('gst_amount', 10, 0)->nullable()->default(0);
            $table->float('total_price', 10, 0)->nullable()->default(0);
            $table->integer('certificate_required')->nullable()->default(0);
            $table->integer('certificate_template_id')->nullable()->default(0);
            $table->integer('is_public_certificate')->nullable()->default(0);
            $table->text('program_policy')->nullable();
            $table->integer('status')->default(0);
            $table->integer('created_by')->nullable()->default(0);
            $table->dateTime('created_at')->useCurrent();
            $table->integer('updated_by')->nullable();
            $table->dateTime('updated_at')->useCurrent();
            $table->integer('deleted_by')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('programs');
    }
}
