<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWishlistableWishlistableTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wishlistable__wishlistable_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields

            $table->integer('wishlistable_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['wishlistable_id', 'locale']);
            $table->foreign('wishlistable_id')->references('id')->on('wishlistable__wishlistables')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wishlistable__wishlistable_translations', function (Blueprint $table) {
            $table->dropForeign(['wishlistable_id']);
        });
        Schema::dropIfExists('wishlistable__wishlistable_translations');
    }
}
