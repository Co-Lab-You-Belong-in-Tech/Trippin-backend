<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $table = 'user_profiles';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'trip_id',
    ];

    // define the relationship between the UserProfile model and the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
