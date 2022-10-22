<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;

   // define the relationship between the Day model and the Itinerary model
    public function itinerary()
    {
        return $this->belongsTo(Itinerary::class, 'itinerary_id');
    }

    // define the relationship between the Day model and the Place model
    public function place()
    {
        return $this->belongsTo(Place::class, 'location_id');
    }
}
