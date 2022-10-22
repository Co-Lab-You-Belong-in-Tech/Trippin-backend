<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;

    // define the relationship between the Place model and the Itinerary model
    public function itineraries()
    {
        return $this->belongsToMany(Itinerary::class, 'days', 'location_id', 'itinerary_id');
    }
}
