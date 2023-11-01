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
use App\Http\Controllers\api\UserOrderController;
use App\Http\Controllers\api\VendorHotelsController;
use App\Http\Controllers\api\ImageController;
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
    Route::get('get-nearbyplaces',[discoverController::class,'index']);

    Route::post('login',[Controller::class,'login']);

    /*start endpoints that user  should be logged and send jwt token to access any of them*/
    Route::group([  'middleware'=>['jwt.verify']],function(){
        Route::apiResource('destinations',destinationController::class)
            ->middleware('admin-access')->only(['store','update','destroy']);
        Route::get('destinations/{destination}',[destinationController::class,'show']);


        Route::post('logout',[Controller::class,'logout']);
    });
    /*end endpoints that user  should be logged and send jwt token to access any of them*/
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('trips', TripController::class);
Route::apiResource('users', UserController::class);
Route::apiResource('restaurants', RestaurantController::class);
// Route::apiResource('hotels', HotelController::class);
// Route::post('vendor-hotel/{hotel}',[HotelController::class,'updateImage']);
Route::apiResource('orders', UserOrderController::class);
// Route::apiResource('vendor-hotels', VendorHotelsController::class);


     Route::post('hotels', [HotelController::class,'store']);
     Route::get('hotels',  [HotelController::class,'index']);
     Route::get('hotels/{hotel}',  [HotelController::class,'show']);
     Route::post('hotels/{hotel}', [HotelController::class,'update']);
     Route::delete('hotels/{hotel}',  [HotelController::class,'destroy']);

     Route::post('images', [ImageController::class,'store']);
     Route::get('images',  [ImageController::class,'index']);
     Route::get('images/{image}',  [ImageController::class,'show']);
     Route::post('images/{image}', [ImageController::class,'updateImage']);
     Route::delete('images/{image}',  [ImageController::class,'destroy']);
    
