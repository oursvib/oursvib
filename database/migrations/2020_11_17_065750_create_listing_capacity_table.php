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
            $table->string('listing_id');
            $table->string('area_by')->nullable();
            $table->string('min_pax')->nullable();
            $table->string('max_pax')->nullable();
            $table->string('seating_pax')->nullable();
            $table->string('standing_pax')->nullable();
            $table->string('cooktail_pax')->nullable();
            $table->string('classroom_pax')->nullable();
            $table->string('theatre_pax')->nullable();
            $table->string('banquet_pax')->nullable();
            $table->string('conference_pax')->nullable();
            $table->string('ushape_pax')->nullable();
            $table->string('height')->nullable();
            $table->string('length')->nullable();
            $table->string('width')->nullable();
            $table->string('screen_size')->nullable();
            $table->string('panel_size')->nullable();
            $table->string('letter_height')->nullable();
            $table->string('best_impact')->nullable();
            $table->string('max_readable_distance')->nullable();
            $table->string('floor_signage_dimension')->nullable();
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
