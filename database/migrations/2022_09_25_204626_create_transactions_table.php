<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('amount');
            $table->enum('type', ['withdraw', 'deposit', 'between_wallets']);

            $table->foreignId('wallet_from')->nullable()->references('id')->on('wallets')->onDelete('cascade');
            $table->foreignId('wallet_to')->nullable()->references('id')->on('wallets')->onDelete('cascade');

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
        Schema::dropIfExists('transactions');
    }
}
