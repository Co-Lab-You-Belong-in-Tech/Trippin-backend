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
        Schema::create('places', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('location_name');
            $table->string('location_address')->nullable();
            $table->string('location_google_map_url');
            $table->double('ratings');
            $table->bigInteger('number_of_reviews');
            $table->string('location_type');
            $table->string('location_icon');
            $table->decimal('location_latitude', 10, 8);
            $table->decimal('location_longitude', 11, 8);
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
        Schema::dropIfExists('places');
    }
};
