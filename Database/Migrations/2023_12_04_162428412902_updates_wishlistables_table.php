<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatesWishlistablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   

        //Check is old migration
        if (Schema::hasColumn('wishlistable__wishlistables', 'user_id'))
        {
            \DB::table('wishlistable__wishlistables')->truncate();

            //Delete User Id
            Schema::table('wishlistable__wishlistables', function (Blueprint $table)
            {   
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            });
        }

        //Add new attributes
        Schema::table('wishlistable__wishlistables', function (Blueprint $table) {

            $table->integer('wishlist_id')->unsigned()->after("id");
            $table->foreign('wishlist_id')->references('id')->on('wishlistable__wishlists')->onDelete('cascade');

            $table->text('options')->nullable()->after("wishlistable_id");

        });
      

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    
    }
}