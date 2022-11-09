<?php


use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//users routes
Route::get('/users/{user}', [UserController::class, 'show']);

//register a new user



//public routes
Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);


//put all protected routes into a group with the middleware auth:sanctum
Route::group(['middleware' => ['auth:sanctum']], function () {
    //Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{user}', [UserController::class, 'show']);

    //user profile route
    Route::get('/users/{user}/profile', [UserController::class, 'profile']);

    // change the user's password
    Route::put('/users/{user}/password', [UserController::class, 'updatePassword']);

    Route::put('/users/{user}', [UserController::class, 'update']);
    Route::delete('/users/{user}', [UserController::class, 'destroy']);
    Route::post('/logout', [UserController::class, 'logout']);
});

