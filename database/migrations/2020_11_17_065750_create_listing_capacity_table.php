<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListingCapacityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listing_capacity', function (Blueprint $table) {
            $table->id();
            $table->integer('listing_id');
            $table->integer('area_by');
            $table->integer('min_pax');
            $table->integer('max_pax');
            $table->integer('seating_pax');
            $table->integer('standing_pax');
            $table->integer('cooktail_pax');
            $table->integer('classroom_pax');
            $table->integer('theatre_pax');
            $table->integer('banquet_pax');
            $table->integer('conference_pax');
            $table->integer('ushape_pax');
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
        Schema::dropIfExists('listing_capacity');
    }
}
