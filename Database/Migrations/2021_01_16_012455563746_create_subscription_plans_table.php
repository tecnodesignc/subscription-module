<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription__plans', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('code');
            $table->boolean('active')->default(true);
            $table->integer('display_order')->nullable();
            $table->boolean('recommendation')->default(false);
            $table->boolean('free')->default(false);
            $table->boolean('visible')->default(false);
            $table->integer('frequency');//30
            $table->string('bill_cycle');//week,month,year
            $table->integer('trial_period')->nullable();
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('subscription__products')->onDelete('cascade');
            $table->text('options')->nullable();

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
        Schema::dropIfExists('subscription__plans');
    }
}
