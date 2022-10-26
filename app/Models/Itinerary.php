<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itinerary extends Model
{
    use HasFactory;

    protected $fillable = [
        'trip_name',
        'trip_destination',
        'trip_start_date',
        'trip_end_date',
        'trip_planner_name',
        'email',
        'destination_google_map_url',
        'trip_background_image_url',


    ];

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
