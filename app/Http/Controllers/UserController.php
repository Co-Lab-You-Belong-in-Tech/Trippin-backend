<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\TripResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //register a new user and hash the password and issue a token and return 201 status code
    public function register(StoreUserRequest $request)
    {
        //trim two letter initials from the email address and use it as the initials and save it to the database
        $initials = substr($request->email, 0, 2);
        $user = User::create($request->validated());
        $user->password = bcrypt($request->password);
        $user->initials = $initials;
        $user->save();
        $token = $user->createToken('API Token of '. $user->email)->plainTextToken;
        $response = [
            'user' => new UserResource($user),
            'token' => $token
        ];
        return response($response, 201);
    }

    //logout the user by revoking the token
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Logged out'
        ]);
    }

    //login the user
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => ['These credentials do not match our records.']
            ], 404);
        }

        $token = $user->createToken('token')->plainTextToken;
        $response = [
            'user' => new UserResource($user),
            'message' => 'Logged in successfully',
            'token' => $token
        ];
        return response($response, 200);
    }

    //retrieve the authenticated user and the  trips associated with the user in the trips table by querying the trip_user pivot table and return the user and the trips in a nested array
    public function profile()
    {
        $user = Auth::user();
        $trips = $user->trips()->get();

        //loop through the trips and display only unique trips
        $uniqueTrips = [];
        foreach ($trips as $trip) {
            if (!in_array($trip, $uniqueTrips)) {
                array_push($uniqueTrips, $trip);
            }
        }
        return response([
            'user' => new UserResource($user),
            'trips' => TripResource::collection($uniqueTrips)
        ]);
    }



    // update the password of the current logged in user by their id and return 200 status code
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|confirmed'
        ]);
        $user = User::find(Auth::id());
        $user->password = bcrypt($request->password);
        $user->save();
        return response()->json([
            'message' => 'Password updated successfully'
        ], 200);
    }




}
