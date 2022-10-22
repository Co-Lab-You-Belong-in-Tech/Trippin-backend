<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itinerary extends Model
{
    use HasFactory;

    // define the relationship between the Itinerary model and the User model
    public function users()
    {
        return $this->belongsToMany(User::class, 'collaborators', 'itinerary_id', 'user_id');
    }

    // define the relationship between the Itinerary model and the Place model
    public function places()
    {
        return $this->belongsToMany(Place::class, 'days', 'itinerary_id', 'location_id');
    }

    // define the relationship between the Itinerary model and the Day model
public function days()
{
    return $this->hasMany(Day::class, 'itinerary_id');
}

}
