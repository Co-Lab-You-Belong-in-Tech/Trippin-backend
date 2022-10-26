<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //register a new user and hash the password and issue a token and return 201 status code
    public function register(StoreUserRequest $request)
    {
        $user = User::create($request->validated());
        $user->password = bcrypt($request->password);
        $user->save();
        $token = $user->createToken('token')->plainTextToken;
        $response = [
            'user' => new UserResource($user),
            'token' => $token
        ];
        return response($response, 201);
    }

    //logout the user
    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return [
            'message' => 'Logged out successfully'
        ];
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
}
