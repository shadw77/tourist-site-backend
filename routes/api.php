<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\api\RestaurantController;
use App\Http\Controllers\api\TripController;
use App\Http\Controllers\api\HotelController;
use App\Http\Controllers\api\HotelImageController;

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


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('restaurants', RestaurantController::class);
Route::apiResource('trips', TripController::class);
Route::apiResource('hotels', HotelController::class);
Route::apiResource('hotelImages', HotelImageController::class);
