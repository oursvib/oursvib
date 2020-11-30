<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->integer('vendor_id');
            $table->integer('root_category');
            $table->integer('parent_category');
            $table->integer('child_category');
            $table->integer('niche_category');
            $table->integer('listing_type');
            $table->integer('status');
            $table->longText('title');
            $table->longText('description');
            $table->longText('about');
            $table->longText('team');
            $table->longText('unique_services');
            $table->longText('stragetic_partner');
            $table->longText('guest_experience');
            $table->longText('news_highlight');
            $table->longText('green_innitiative');
            $table->longText('star_rating');
            $table->integer('csr_partner');
            $table->integer('food_partner');
            $table->integer('capacity_by');
            $table->longText('address');
            $table->integer('city');
            $table->integer('state');
            $table->integer('country');
           // $table->string('town');
            $table->string('zipcode');
          //  $table->longText('amenities');
          //  $table->longText('images');
            $table->longText('video');
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
        Schema::dropIfExists('listings');
    }
}
