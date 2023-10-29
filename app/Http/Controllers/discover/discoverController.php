<?php

namespace App\Http\Controllers\discover;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Destination;
use App\Models\Restaurant;
use App\Models\Hotel;
use App\Models\Trip;
use App\Models\User;
use App\Models\Review;
use App\Models\Room;
use App\Models\Image;
use App\Traits\GeneralTrait;


class discoverController extends Controller
{
    use GeneralTrait;

    /*start function that send nearbyplaces*/
    public function index(){

        $restaurantnearbyplaces=Restaurant::where('government','luxor')->get();
        $tripnearbyplaces=Trip::where('government','luxor')->get();
        $hotelnearbyplaces=Hotel::where('government','luxor')->get();
        return $this->returnData(
            "nearbyplaces",
            [
                'hotels' => $hotelnearbyplaces,
                'restaurant' => $restaurantnearbyplaces,
                'trip' => $hotelnearbyplaces
            ]
            ,'data Found'
        );
    }
    /*end function that send nearbyplaces*/

    /*start function that retrieve review that belong to nearbyplaces*/
    public function getReviewNearByPlaces(){
        $tripwithreview=Trip::where('government','luxor')->has('reviews')->with('reviews.user')->get();
        $restaurantwithreview=Restaurant::where('government','luxor')->has('reviews')->with('reviews.user')->get();
        $hotelwithreview=Hotel::where('government','luxor')->has('reviews')->with('reviews.user')->get();

        /*start extract reviews from $tripwithreview*/
        $tripreview = [];
        foreach($tripwithreview as $trip) {
            $tripreview = array_merge($tripreview, $trip->reviews->toArray());
        }
        /*end extract reviews from $tripwithreview*/

        /*start extract reviews from $restaurantwithreview*/
        $restaurantreview = [];
        foreach($restaurantwithreview as $trip) {
            $restaurantreview = array_merge($restaurantreview, $trip->reviews->toArray());
        }
        /*end extract reviews from $restaurantwithreview*/

        /*start extract reviews from $hotelwithreview*/
        $hotelreview = [];
        foreach($hotelwithreview as $trip) {
            $hotelreview = array_merge($hotelreview, $trip->reviews->toArray());
        }
        /*end extract reviews from $hotelwithreview*/

        return $this->returnData(
            "reviews",
            [
                'tripreview' => $tripreview,
                'restaurantreview' => $restaurantreview,
                'hotelreview' => $hotelreview
            ]
            ,'data Found'
        );
    }
    /*end function that retrieve review that belong to nearbyplaces*/

    /*start testing function that insert review*/
    public function store(Request $request){
        $trip=Trip::find($request->trip_id);
        $review = new Review();
        $review->review = $request->review;
        $review->user_id=$request->user_id;
        $trip->reviews()->save($review);

        $this->returnSuccessMessage("comment Inserted successuflly","E001");
    }
    /*end testing function that insert review*/

}
