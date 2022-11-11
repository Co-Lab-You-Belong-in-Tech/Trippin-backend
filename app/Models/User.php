<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\Uuids;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'initials',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // define the relationship between the User model and the Trip model
    public function trips()
    {
        return $this->belongsToMany(Trip::class, 'trip_user', 'user_id', 'trip_id');
    }

    // define the relationship between the User model and the TripUser model
    public function user_trips()
    {
        return $this->hasMany(TripUser::class, 'user_id');
    }

    // define the relationship between the User model and the UserProfile model
    public function userProfile()
    {
        return $this->hasOne(UserProfile::class, 'user_id');
    }
}
