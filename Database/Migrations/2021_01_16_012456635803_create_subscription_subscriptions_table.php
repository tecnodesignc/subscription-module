<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription__subscriptions', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->date('init_date');
            $table->date('end_date');
            $table->smallInteger('status')->default(0);
            $table->float('total', 30, 2)->default(0);
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on(config('auth.table', 'users'))->onDelete('restrict');
            $table->integer('plan_id')->unsigned();
            $table->foreign('plan_id')->references('id')->on("subscription__plans")->onDelete('restrict');
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
        Schema::dropIfExists('subscription__subscriptions');
    }
}
