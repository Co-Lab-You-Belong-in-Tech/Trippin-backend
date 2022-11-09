<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itinerary extends Model
{
    use HasFactory;

    protected $table = 'itineraries';
    protected $dates = ['start_date', 'end_date'];

    protected $primaryKey = 'id';

    protected $fillable = [
        'location_name',
        'description',
        'itinerary_start_time',
        'itinerary_end_time',
        'location_latitude',
        'location_longitude',
        'location_image',
        'itinerary_date',
        'ratings',
        'number_of_reviews',
        'location_type',
        'location_google_map_url',

    ];

    // define the relationship between the Itinerary model and the User model
    public function users()
    {
        return $this->belongsToMany(User::class, 'collaborators', 'trip_id', 'user_id');
    }

    /*// define the relationship between the Itinerary model and the Place model
    public function places()
    {
        return $this->belongsToMany(Place::class, 'days', 'itinerary_id', 'location_id');
    }*/

    // define the relationship between the Itinerary model and the Day model
/*public function days()
{
    return $this->hasMany(Day::class, 'itinerary_id');
}*/

// define the relationship between the Itinerary model and the Trip model
public function trip()
{
    return $this->belongsTo(Trip::class, 'trip_id', 'id');
}

}


