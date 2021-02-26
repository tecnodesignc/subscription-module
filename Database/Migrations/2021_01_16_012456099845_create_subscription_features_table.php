<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription__features', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->boolean('active')->default(true);
            $table->integer('type');
            $table->string('unit')->nullable();
            $table->boolean('is_visible')->default(1);
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
        Schema::dropIfExists('subscription__features');
    }
}
