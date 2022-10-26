<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTrip extends Model
{
    use HasFactory;

    // define the relationship between the UserTrip model and the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
