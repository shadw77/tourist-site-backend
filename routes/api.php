<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\discover\discoverController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\destination\destinationController;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\api\RestaurantController;
use App\Http\Controllers\api\TripController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\HotelController;
use App\Http\Controllers\api\HotelImageController;
use App\Http\Controllers\review\reviewController;

use App\Http\Controllers\api\UserOrderController;
use App\Http\Controllers\PasswordResetRequestController;
use App\Http\Controllers\chagePasswordController;
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


Route::group(['middleware'=>['api']],function(){


    /*start endpoints for authentication*/
    Route::post('register',[Controller::class,'register']);
    Route::post('login',[Controller::class,'login']);
    Route::post('sendPasswordResetLink',[PasswordResetRequestController::class,'sendPasswordResetEmail']);
    Route::post('resetPassword',[chagePasswordController::class,'process']);
    Route::get('auth/redirect', [Controller::class,'githubLogin']);//for github login
    Route::get('auth/callback', [Controller::class,'githubredirect']);//for github login
    Route::get('google/auth/redirect', [Controller::class,'googleLogin']);//for google login
    Route::get('google/auth/callback', [Controller::class,'googleredirect']);//for google login
    /*end endpoints for authentication*/

    Route::post('review',[discoverController::class,'store']);//for test


    /*start endpoints for discover*/
    Route::get('get-nearbyplaces/{city}',[discoverController::class,'index']);
    Route::get('get-review-nearbyplaces/{city}',[discoverController::class,'getReviewNearByPlaces']);
    Route::get('get-topattractions-places',[discoverController::class,'getTopAttractions']);
    Route::get('get-review-topattractions-places',[discoverController::class,'getReviewTopAttractions']);
    /*end endpoints for discover*/


    /*start endpoints that user  should be logged and send jwt token to access any of them*/
    Route::group([  'middleware'=>['jwt.verify']],function(){

        Route::get("get-test-data",[Controller::class,'testdata']);//for test
        Route::get('logout',[Controller::class,'logout']);//function that logout

        /*start endpoints for destination that can anyone access*/
        Route::get('destinations',[destinationController::class,'index']);
        Route::get('destinations/{id}',[destinationController::class,'show']);
        /*end endpoints for destination that can anyone access*/

        /*start endpoints that can only admin access*/
        Route::group([  'middleware'=>['admin-access'] ],function(){

            /*start endpoints for destination*/
            Route::delete('destinations/{destination}',[destinationController::class,'destroy']);
            Route::post('destinations',[destinationController::class,'store']);
            Route::put('destinations/{destination}',[destinationController::class,'update']);
            /*end endpoints for destination*/

        });
        /*end endpoints that can only admin access*/

        /*start endpoints that admin or vendor can access*/
        Route::group([  'middleware'=>['admin-vendor-access'] ],function(){

        });
        /*end endpoints that admin or vendor can access*/

    });
    /*end endpoints that user  should be logged and send jwt token to access any of them*/
});



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('trips', TripController::class);
Route::apiResource('users', UserController::class);
Route::apiResource('restaurants', RestaurantController::class);
Route::apiResource('hotels', HotelController::class);
Route::apiResource('hotelImages', HotelImageController::class);
Route::apiResource('orders', UserOrderController::class);
