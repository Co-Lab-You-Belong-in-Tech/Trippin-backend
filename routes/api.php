<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//register routes
Route::prefix('v1')->group(function(){
    $files = glob(__DIR__ . '/api/v1/*.php');
    foreach ($files as $file) {
        require $file;
    }
});

