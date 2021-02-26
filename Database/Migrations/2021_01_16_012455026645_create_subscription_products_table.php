<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription__products', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('system_name');
            $table->boolean('require_shipping_address')->default(false);
            $table->boolean('active')->default(true);
            $table->integer('user_id')->unsigned();
            $table->text('options')->nullable();
            $table->foreign('user_id')->references('id')->on(config('auth.table', 'users'))->onDelete('restrict');
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
        Schema::dropIfExists('subscription__products');
    }
}
