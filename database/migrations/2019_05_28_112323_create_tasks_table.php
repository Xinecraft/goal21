<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid');
            $table->integer('type'); // 0 - apps download, 2 - videos , 1 - websites
            $table->string('link');
            $table->integer('wait_in_seconds')->nullable();
            $table->boolean('is_active')->default(true);
            $table->float('credit_inr');
            $table->smallInteger('weight')->default(0);
            $table->text('description')->nullable();
            $table->integer('total_impression')->default(0);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('tasks');
    }
}
