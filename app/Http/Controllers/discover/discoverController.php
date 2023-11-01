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
    private $condition=">=";
    private $Rating=2;
    private $numberofRecords=2;

    /*start function that send nearbyplaces*/
    public function index($city){

        $restaurantnearbyplaces=Restaurant::where('government',$city)->get();
        $tripnearbyplaces=Trip::where('government',$city)->get();
        $hotelnearbyplaces=Hotel::where('government',$city)->get();
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
    public function getReviewNearByPlaces($city){
        $tripwithreview=Trip::where('government',$city)->has('reviews')->with('reviews.user')->get();
        $restaurantwithreview=Restaurant::where('government',$city)->has('reviews')->with('reviews.user')->get();
        $hotelwithreview=Hotel::where('government',$city)->has('reviews')->with('reviews.user')->get();

        //start extract reviews from $tripwithreview
        $tripreview = $this->getReview($tripwithreview);

        //start extract reviews from $restaurantwithreview
        $restaurantreview = $this->getReview($restaurantwithreview);

        //start extract reviews from $hotelwithreview
        $hotelreview = $this->getReview($hotelwithreview);

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

   /*start function that send top attractions*/
   public function getTopAttractions(){
        $hotelTopAttractions=Hotel::where('rating',$this->condition,$this->Rating)->take($this->numberofRecords)->get();
        $restaurantTopAttractions=Restaurant::where('rating',$this->condition,$this->Rating)->take($this->numberofRecords)->get();
        $tripTopAttractions=Trip::where('rating',$this->condition,$this->Rating)->take($this->numberofRecords)->get();
        return $this->returnData(
            "topAttractions",
            [
                'hotels' => $hotelTopAttractions,
                'restaurants' => $restaurantTopAttractions,
                'trips' => $tripTopAttractions
            ]
            ,'Data Found'
        );
    }
    /*end function that send top attractions*/

    /*start function that retrieve review that belong to top attractions*/
    public function getReviewTopAttractions(){
        $tripwithreview=Trip::where('rating',$this->condition,$this->Rating)->has('reviews')->with('reviews.user')->get();
        $restaurantwithreview=Restaurant::where('rating',$this->condition,$this->Rating)->has('reviews')->with('reviews.user')->get();
        $hotelwithreview=Hotel::where('rating',$this->condition,$this->Rating)->has('reviews')->with('reviews.user')->get();

        //start extract reviews from $tripwithreview
        $tripreview = $this->getReview($tripwithreview);

        //start extract reviews from $restaurantwithreview
        $restaurantreview = $this->getReview($restaurantwithreview);

        //start extract reviews from $hotelwithreview
        $hotelreview = $this->getReview($hotelwithreview);

        return $this->returnData(
            "reviews",
            [
                'tripreview' => $tripreview,
                'restaurantreview' => $restaurantreview,
                'hotelreview' => $hotelreview
            ]
            ,'Data Found'
        );
    }
    /*end function that retrieve review that belong to  top attractions*/


    /*start function that get review from passed object*/
    public function getReview($passedObject){
        $review=[];
        foreach($passedObject as $bject) {
            $review = array_merge($review, $bject->reviews->toArray());
        }
        return $review;
    }
    /*end function that get review from passed object*/

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
