<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListingPriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listing_price', function (Blueprint $table) {
            $table->id();
            $table->integer('listing_id');
            $table->integer('billing_type');
            $table->integer('peak_start');
            $table->integer('peak_end');
            $table->string('normal_price');
            $table->string('peak_price');
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
        Schema::dropIfExists('listing_price');
    }
}
