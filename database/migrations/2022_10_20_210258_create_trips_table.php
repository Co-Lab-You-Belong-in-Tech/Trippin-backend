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
        Schema::create('trips', function (Blueprint $table) {
            $table->increments('id');
            $table->string('trip_name');
            //$table->string('trip_code')->nullable();
            $table->string('trip_destination');
            $table->string('trip_planner_name')->nullable();
            $table->date('trip_start_date');
            $table->date('trip_end_date');
            $table->string('destination_google_map_url')->nullable();
            $table->string('trip_background_image')->nullable();
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
        Schema::dropIfExists('trips');
    }
};
