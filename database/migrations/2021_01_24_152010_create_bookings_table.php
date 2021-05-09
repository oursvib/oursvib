<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->integer('vendor_id');
            $table->integer('listing_id');
            $table->integer('user_id');
            $table->integer('blockings');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('booking_ref_no');
            $table->integer('booking_progress')->default('0')->comment('1=>bookinginprogress,2=>bookedsuccessfully,0=>blocked by vendors');
            $table->string('amountpaid')->default('0');
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
        Schema::dropIfExists('bookings');
    }
}
