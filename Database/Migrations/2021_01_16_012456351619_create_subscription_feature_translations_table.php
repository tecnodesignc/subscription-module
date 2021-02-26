<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionFeatureTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription__feature_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('caption')->nullable();
            $table->text('description')->nullable();

            $table->integer('feature_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['feature_id', 'locale']);
            $table->foreign('feature_id')->references('id')->on('subscription__features')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subscription__feature_translations', function (Blueprint $table) {
            $table->dropForeign(['feature_id']);
        });
        Schema::dropIfExists('subscription__feature_translations');
    }
}
