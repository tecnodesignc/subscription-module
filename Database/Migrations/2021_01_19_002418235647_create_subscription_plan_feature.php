<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionPlanFeature extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription__plan_feature', function (Blueprint $table) {
            $table->id();
            $table->integer('feature_id')->unsigned();
            $table->integer('plan_id')->unsigned();
            $table->string('value');
            $table->string('plan_caption')->nullable();
            $table->foreign('feature_id')->references('id')->on('subscription__features')->onDelete('cascade');
            $table->foreign('plan_id')->references('id')->on('subscription__plans')->onDelete('cascade');
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
        Schema::dropIfExists('subscription__plan_feature');
    }
}
