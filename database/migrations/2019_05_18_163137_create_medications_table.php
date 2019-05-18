<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedBigInteger('user_id');
            $table->float('quantity_amount')->default(1.0);
            $table->string('quantity_type')->default('tablet');
            $table->dateTime('start_date')->default(\Carbon\Carbon::today());
            $table->dateTime('end_date');
            $table->string('codes')->nullable();
            $table->string('store_phone')->nullable();
            $table->string('frequency')->default('daily');
            $table->string('time')->default('09:00:00');
            $table->boolean('refillable')->default(false);
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
        Schema::dropIfExists('medications');
    }
}
