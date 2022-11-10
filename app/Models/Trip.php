<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $table = 'trips';

    protected $primaryKey = 'id';

    protected $fillable = [
        'trip_name',
        'trip_destination',
        'trip_start_date',
        'trip_end_date',
        'trip_planner_name',
        'email',
        'destination_google_map_url',
        'trip_background_image',
        'user_id',
    ];

    // define the relationship between the Trip model and the User model
    public function users()
    {
        return $this->belongsToMany(User::class, 'trip_user', 'trip_id', 'user_id');
    }

    // define the relationship between the Trip model and the TripUser model
    public function trip_user()
    {
        return $this->hasMany(TripUser::class, 'trip_id');
    }

    // define the relationship between the Trip model and the Itinerary model
    public function itineraries()
    {
        return $this->hasMany(Itinerary::class, 'trip_id', 'id');
    }
}
