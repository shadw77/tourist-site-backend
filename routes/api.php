<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\discover\discoverController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\destination\destinationController;
use App\Http\Controllers\api\NotifyController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\api\RestaurantController;
use App\Http\Controllers\api\TripController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\HotelController;
use App\Http\Controllers\api\HotelImageController;
use App\Http\Controllers\review\reviewController;
use App\Http\Controllers\api\TransactionController;
use App\Http\Controllers\api\UserOrderController;
 //use App\Http\Controllers\api\DestinationController;
// use App\Http\Controllers\destinationController;
use App\Http\Controllers\api\VendorHotelsController;
use App\Http\Controllers\api\ImageController;
use App\Http\Controllers\PasswordResetRequestController;
use App\Http\Controllers\chagePasswordController;

use App\Http\Controllers\api\user\HotelUserController;
use App\Http\Controllers\api\user\DestinationUserController;
use App\Http\Controllers\api\user\TripUserController;
use App\Http\Controllers\api\user\RestaurantUserController;
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

    // /start endpoints for authentication/
    Route::post('register',[Controller::class,'register']);
    Route::post('login',[Controller::class,'login']);
    Route::post('sendPasswordResetLink',[PasswordResetRequestController::class,'sendPasswordResetEmail']);
    Route::post('resetPassword',[chagePasswordController::class,'process']);
    Route::get('auth/redirect', [Controller::class,'githubLogin']);//for github login
    Route::get('auth/callback', [Controller::class,'githubredirect']);//for github login
    Route::get('google/auth/redirect', [Controller::class,'googleLogin']);//for google login
    Route::get('google/auth/callback', [Controller::class,'googleredirect']);//for google login
    // /end endpoints for authentication/

    Route::post('send-message',[Controller::class,'sendMessage']);


    // /start endpoints that handled in detail component/
    Route::post('get-review',[discoverController::class,'reviewById']);
    // /end endpoints that handled in detail component/

    Route::get('get-nearbyplaces',[discoverController::class,'index']);
    Route::get('get-review-nearbyplaces',[discoverController::class,'getReviewNearByPlaces']);
    Route::get('get-topattractions-places',[discoverController::class,'getTopAttractions']);
    Route::get('get-review-topattractions-places',[discoverController::class,'getReviewTopAttractions']);
    Route::get('get-offers-places',[discoverController::class,'getOffers']);
    Route::get('get-review-offers-places',[discoverController::class,'getReviewOffers']);

    // /end endpoints for discover/

    Route::get('/notifications/{id}', [UserOrderController::class, 'getNotifications']);
    Route::get('user-trips',  [TripUserController::class,'index']);
    Route::get('user-hotels',  [HotelUserController::class,'index']);
    Route::get('user-restaurants',  [RestaurantUserController::class,'index']);
    Route::get('user-destinations',[destinationController::class,'index']);
    Route::get('/notify',  [NotifyController::class,'index']);
    Route::put('/notify',  [NotifyController::class,'update']);

    Route::get('/topDestinations', [destinationController::class, 'getDestinations']);
    Route::get('/searchTrip', [TripController::class, 'searchTrips']);
    Route::get('/searchDestination', [DestinationController::class, 'searchDestinations']);
    Route::get('/searchRestaurant', [RestaurantController::class, 'searchRestaurants']);
    Route::get('/searchHotel', [HotelController::class, 'searchHotels']);
    Route::post('/create-time-slot/{serviceType}/{serviceId}', [TimeSlotController::class,'createTimeSlot']);
    Route::get('/searchHotelByTime', [HotelController::class,'searchHotelByTime']);
    Route::get('/searchTripByTime', [TripController::class,'searchTripByTime']);
    Route::get('/searchRestaurantByTime', [RestaurantController::class,'searchRestaurantByTime']);


    Route::apiResource('users', UserController::class);
    Route::get('images',  [ImageController::class,'index']);
    Route::get('images/{image}',  [ImageController::class,'show']);

    // /start endpoints that user  should be logged and send jwt token to access any of them/
     Route::group([ 'middleware'=>['jwt.verify']],function(){

        Route::post('review',[discoverController::class,'store']);//add comment
        Route::get("get-test-data",[Controller::class,'testdata']);//for test
        Route::post('logout',[Controller::class,'logout']);      //function that logout
        Route::post('/checkout', [UserOrderController::class,'checkout']);
        Route::apiResource('orders', UserOrderController::class);
        Route::get('users/{user}', [UserController::class,'show']);
        Route::put('users/{user}', [UserController::class,'update']);



        // /start endpoint that deal with payment gateway/
        Route::get('orders/payment', [UserOrderController::class,'confirm_order']);
        Route::get('callback', [UserOrderController::class, 'paymentCallBack']);
        Route::get('error', function () {
            return view('payment.failed');
        });
        // /end endpoint that deal with payment gateway/

        // /start endpoints that can only admin access/
        Route::group(['middleware'=>['admin-access'] ],function(){

        });
        // /end endpoints that can only admin access/

        // /start endpoints that admin or vendor can access/
        Route::group(['middleware'=>['admin-vendor-access'] ],function(){
            Route::apiResource('transaction', TransactionController::class);
            Route::get('hotels/discounted', [HotelController::class,'getDiscountedHotels']);
            Route::get('trips/discounted',  [TripController::class,'getDiscountedTrips']);
            Route::get('restaurants/discounted',  [RestaurantController::class,'getDiscountedRestaurant']);
            Route::get('destinations',[destinationController::class,'index']);
            Route::get('destinations/{id}',[destinationController::class,'show']);
            Route::delete('destinations/{destination}',[destinationController::class,'destroy']);
            Route::post('destinations',[destinationController::class,'store']);
            Route::post('destinations/{destination}',[destinationController::class,'update']);

            Route::get('trips',  [TripController::class,'index']);
            Route::post('trips', [TripController::class,'store']);
            Route::get('trips/{trip}',  [TripController::class,'show']);
            Route::post('trips/{trip}', [TripController::class,'update']);
            Route::delete('trips/{trip}',  [TripController::class,'destroy']);

            Route::get('restaurants',  [RestaurantController::class,'index']);
            Route::get('restaurants/{restaurant}',  [RestaurantController::class,'show']);
            Route::post('restaurants', [RestaurantController::class,'store']);
            Route::post('restaurants/{restaurant}', [RestaurantController::class,'update']);
            Route::delete('restaurants/{restaurant}',  [RestaurantController::class,'destroy']);

            Route::get('hotels',  [HotelController::class,'index']);
            Route::post('hotels', [HotelController::class,'store']);
            Route::get('hotels/{hotel}',  [HotelController::class,'show']);
            Route::post('hotels/{hotel}', [HotelController::class,'update']);
            Route::delete('hotels/{hotel}',  [HotelController::class,'destroy']);

            Route::post('images', [ImageController::class,'store']);
            Route::post('images/{image}', [ImageController::class,'updateImage']);
            Route::delete('images/{image}',  [ImageController::class,'destroy']);
            Route::post('users', [UserController::class,'store']);
            Route::delete('users', [UserController::class,'destroy']);
            Route::get('users', [UserController::class,'index']);


        //    Route::apiResource('users', UserController::class);
        //   Route::apiResource('orders', UserOrderController::class);
         Route::get('ordersdetails/{order}', [UserOrderController::class,'showOrderDetails']);
         Route::get('service-user', [UserOrderController::class,'userService']);
         Route::get('vendor-orders', [UserOrderController::class,'allIndex']);
         Route::get('get-discount', [discoverController::class,'getDiscounted']);



        });
        // /end endpoints that admin or vendor can access/
    });
    Route::apiResource('orders', UserOrderController::class);


    // /end endpoints that user  should be logged and send jwt token to access any of them/


});
