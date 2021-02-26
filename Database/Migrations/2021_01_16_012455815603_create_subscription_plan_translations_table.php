<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionPlanTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription__plan_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->double('price',30,2)->nullable();
            $table->integer('plan_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['plan_id', 'locale']);
            $table->foreign('plan_id')->references('id')->on('subscription__plans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subscription__plan_translations', function (Blueprint $table) {
            $table->dropForeign(['plan_id']);
        });
        Schema::dropIfExists('subscription__plan_translations');
    }
}
