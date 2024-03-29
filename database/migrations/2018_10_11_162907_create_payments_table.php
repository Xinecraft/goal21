<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid')->unique();
            $table->unsignedBigInteger('user_id');
            $table->string('payment_method');
            $table->text('payment_data')->nullable();
            $table->double('payment_amount');
            $table->string('payment_txn_id')->nullable();
            $table->tinyInteger('payment_status')->default(0);
            $table->dateTime('paid_at')->nullable();
            //$table->dateTime('verified_at')->nullable();
            //$table->boolean('is_verified_by_admin')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
