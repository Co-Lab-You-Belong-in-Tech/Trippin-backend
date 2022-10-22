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
            $table->string('trip_name');
            $table->string('trip_destination');
            $table->string('trip_planner_name')->nullable();
            $table->string('email')->nullable();
            $table->date('trip_start_date');
            $table->date('trip_end_date');
            $table->foreignId('location_id')->nullable()->index();
            $table->foreignId('day_id')->nullable()->index();
            $table->foreign('location_id')->references('id')->on('places')->cascadeOnDelete();
            $table->foreign('day_id')->references('id')->on('days')->cascadeOnDelete();
            $table->string('destination_google_map_url');
            $table->string('trip_background_image_url');
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
