<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itineraries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('itinerary_start_time');
            $table->date('itinerary_end_time');
            $table->date('itinerary_date');
            $table->foreignId('user_trip_id')->index();
            $table->foreign('user_trip_id')->references('id')->on('user_trips')->cascadeOnDelete();
            $table->foreignId('trip_id')->index();
            $table->foreign('trip_id')->references('id')->on('trips')->cascadeOnDelete();
            $table->foreignId('location_id')->nullable()->index();
            $table->foreign('location_id')->references('id')->on('places')->cascadeOnDelete();
            $table->softDeletes();
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
        Schema::dropIfExists('itineraries');
    }
};
