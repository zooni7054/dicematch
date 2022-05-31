<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_package_id')->nullable()->constrained('product_packages')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->integer('amount')->default(0)->unsigned();
            $table->integer('discount_amount')->default(0)->unsigned();
            $table->integer('gst_amount')->default(0)->unsigned();
            $table->integer('gst_percentage')->default(0)->unsigned();
            $table->integer('gross_amount')->default(0)->unsigned();
            $table->integer('net_amount')->default(0)->unsigned();
            $table->date('due_date')->nullable();
            $table->enum('status', ['pending', 'paid', 'expired'])->default('pending');
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
        Schema::dropIfExists('invoices');
    }
}
