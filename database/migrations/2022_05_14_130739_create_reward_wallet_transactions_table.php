<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRewardWalletTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reward_wallet_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reward_wallet_id')->nullable()->constrained('reward_wallets')->onDelete('cascade');
            $table->morphs('transable');
            $table->integer('points')->default(0)->unsigned();
            $table->integer('balance')->default(0);
            $table->enum('status', ['added', 'deducted'])->default('added');
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('reward_wallet_transactions');
    }
}
