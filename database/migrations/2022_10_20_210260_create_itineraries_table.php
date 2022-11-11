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
            $table->increments('id');
            $table->string('location_name');
            $table->string('description')->nullable();
            $table->string('itinerary_start_time')->nullable();
            $table->string('itinerary_end_time')->nullable();
            $table->string('itinerary_date')->nullable();
            $table->string('location_address')->nullable();
            $table->string('location_google_map_url')->nullable();
            $table->decimal('location_latitude')->nullable();
            $table->decimal('location_longitude')->nullable();
            $table->string('location_image')->nullable();
            $table->double('ratings')->nullable();
            $table->bigInteger('number_of_reviews')->nullable();
            $table->string('location_type')->nullable();
            //$table->boolean('is_public')->default(false)->nullable();
            $table->foreignId('user_id')->index();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreignId('trip_id')->index();
            $table->foreign('trip_id')->references('id')->on('trips')->cascadeOnDelete();
            //$table->foreignId('location_id')->nullable()->index();
            //$table->foreign('location_id')->references('id')->on('places')->cascadeOnDelete();
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
