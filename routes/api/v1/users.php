<?php


use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//users routes
Route::get('/users/{user}', [UserController::class, 'show']);

//register a new user
Route::post('/register', [UserController::class, 'register']);

//logout the user
Route::post('/logout', [UserController::class, 'logout']);

//login the user
Route::post('/login', [UserController::class, 'login']);


Route::put('/users/{user}', [UserController::class, 'update']);

Route::delete('/users/{user}', [UserController::class, 'destroy']);

