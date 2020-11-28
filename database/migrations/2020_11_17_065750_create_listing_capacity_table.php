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
            $table->integer('area_by')->nullable();
            $table->integer('min_pax')->nullable();
            $table->integer('max_pax')->nullable();
            $table->integer('seating_pax')->nullable();
            $table->integer('standing_pax')->nullable();
            $table->integer('cooktail_pax')->nullable();
            $table->integer('classroom_pax')->nullable();
            $table->integer('theatre_pax')->nullable();
            $table->integer('banquet_pax')->nullable();
            $table->integer('conference_pax')->nullable();
            $table->integer('ushape_pax')->nullable();
            $table->integer('height')->nullable();
            $table->integer('length')->nullable();
            $table->integer('width')->nullable();
            $table->integer('screen_size')->nullable();
            $table->integer('panel_size')->nullable();
            $table->integer('letter_height')->nullable();
            $table->integer('best_impact')->nullable();
            $table->integer('max_readable_distance')->nullable();
            $table->integer('floor_signage_dimension')->nullable();
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
