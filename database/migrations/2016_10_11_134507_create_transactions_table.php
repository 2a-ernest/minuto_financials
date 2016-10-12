<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->timestamps();
            $table->integer('transaction_type_id')->unsigned();
            $table->integer('debit_account_id')->unsigned();
            $table->integer('credit_account_id')->unsigned();
            $table->integer('amount')->unsigned();
            $table->foreign('transaction_type_id')->references('id')->on('transaction_types')->onDelete('cascade');
            $table->foreign('debit_account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreign('credit_account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->longText('location');
            $table->longText('description');
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
