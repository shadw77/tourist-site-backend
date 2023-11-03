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
 //use App\Http\Controllers\api\DestinationController;
// use App\Http\Controllers\destinationController;

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



// Route::group(['middleware'=>['api']],function(){
//     Route::get('get-nearbyplaces',[discoverController::class,'index']);

//     Route::post('login',[Controller::class,'login']);

//     /*start endpoints that user  should be logged and send jwt token to access any of them*/
//     Route::group([  'middleware'=>['jwt.verify']],function(){
//         Route::apiResource('destinations',destinationController::class)
//             ->middleware('admin-access')->only(['store','update','destroy']);
//         Route::get('destinations/{destination}',[destinationController::class,'show']);
Route::group(['middleware'=>['api']],function(){

    /*start endpoints for authentication*/
    Route::post('register',[Controller::class,'register']);
    Route::post('login',[Controller::class,'login']);
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
        Route::get('logout',[Controller::class,'logout']);

//         Route::post('logout',[Controller::class,'logout']);
//     });
//     /*end endpoints that user  should be logged and send jwt token to access any of them*/
        /*start endpoints for destination that can anyone access*/
     
        /*end endpoints for destination that can anyone access*/

        /*start endpoints that can only admin access*/
 Route::group([  'middleware'=>['admin-access'] ],function(){

            /*start endpoints for destination*/
  
            /*end endpoints for destination*/

        });
        /*end endpoints that can only admin access*/
    Route::post('/checkout', [UserOrderController::class,'checkout']);

// });
    });
    Route::get('destinations',[destinationController::class,'index']);
     Route::get('destinations/{id}',[destinationController::class,'show']);
     Route::delete('destinations/{destination}',[destinationController::class,'destroy']);
     Route::post('destinations',[destinationController::class,'store']);
     Route::put('destinations/{destination}',[destinationController::class,'update']);
    /*end endpoints that user  should be logged and send jwt token to access any of them*/
      
Route::get('destinations',[destinationController::class,'index']);
Route::get('destinations/{id}',[destinationController::class,'show']);
Route::delete('destinations/{destination}',[destinationController::class,'destroy']);
Route::post('destinations',[destinationController::class,'store']);
Route::post('destinations/{destination}',[destinationController::class,'update']);
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



// Route::apiResource('destinations', DestinationController::class);
Route::get('/topDestinations', [destinationController::class, 'getDestinations']);
// Route::apiResource('destinations', DestinationController::class);
// Route::get('/destinations', [DestinationController::class, 'getDestinations']);
// Route::apiResource('trips', TripController::class);


Route::get('/searchTrip', [TripController::class, 'searchTrips']);
Route::get('/searchDestination', [DestinationController::class, 'searchDestinations']);
Route::get('/searchRestaurant', [RestaurantController::class, 'searchRestaurants']);
Route::get('/searchHotel', [HotelController::class, 'searchHotels']);



// Route::apiResource('trips', TripController::class);
Route::apiResource('users', UserController::class);
// Route::apiResource('restaurants', RestaurantController::class);
// Route::apiResource('hotels', HotelController::class);
// Route::post('vendor-hotel/{hotel}',[HotelController::class,'updateImage']);
Route::apiResource('orders', UserOrderController::class);
// Route::apiResource('vendor-hotels', VendorHotelsController::class);


     Route::post('trips', [TripController::class,'store']);
     Route::get('trips',  [TripController::class,'index']);
     Route::get('trips/{trip}',  [TripController::class,'show']);
     Route::post('trips/{trip}', [TripController::class,'update']);
     Route::delete('trips/{trip}',  [TripController::class,'destroy']);

     Route::post('hotels', [HotelController::class,'store']);
     Route::get('hotels',  [HotelController::class,'index']);
     Route::get('hotels/{hotel}',  [HotelController::class,'show']);
     Route::post('hotels/{hotel}', [HotelController::class,'update']);
     Route::delete('hotels/{hotel}',  [HotelController::class,'destroy']);

     Route::post('restaurants', [RestaurantController::class,'store']);
     Route::get('restaurants',  [RestaurantController::class,'index']);
     Route::get('restaurants/{restaurantl}',  [RestaurantController::class,'show']);
     Route::post('restaurants/{restaurant}', [RestaurantController::class,'update']);
     Route::delete('restaurants/{restaurant}',  [RestaurantController::class,'destroy']);

     Route::post('images', [ImageController::class,'store']);
     Route::get('images',  [ImageController::class,'index']);
     Route::get('images/{image}',  [ImageController::class,'show']);
     Route::post('images/{image}', [ImageController::class,'updateImage']);
     Route::delete('images/{image}',  [ImageController::class,'destroy']);
    
     