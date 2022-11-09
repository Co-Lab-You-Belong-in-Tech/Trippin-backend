<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TripUser extends Model
{
    use HasFactory;

    // define the relationship between the TripUser model and the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
