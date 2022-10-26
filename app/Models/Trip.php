<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
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

    // define the relationship between the Trip model and the User model
    public function user()
    {
        return $this->belongsToMany(User::class, 'user_trips', 'trip_id', 'user_id');
    }

    // define the relationship between the Trip model and the UserTrip model
    public function user_trips()
    {
        return $this->hasMany(UserTrip::class, 'trip_id');
    }

    // define the relationship between the Trip model and the Itinerary model
    public function itineraries()
    {
        return $this->hasMany(Itinerary::class, 'user_trip_id');
    }
}
