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
use Log;

class discoverController extends Controller
{
    use GeneralTrait;
    private $condition=">=";
    private $Rating=2;
    private $numberofRecords=2;

    /*start function that send nearbyplaces*/
    public function index($city){
        //return $city;
        $restaurantnearbyplaces=Restaurant::with(['images', 'reviews.user']);
        $tripnearbyplaces=Trip::with(['images', 'reviews.user']);
        $hotelnearbyplaces=Hotel::with(['images', 'reviews.user']);

        if ($city !== 'null') {
            Log::info($city);
            $restaurantnearbyplaces = $restaurantnearbyplaces->where('government', $city);
            $tripnearbyplaces = $tripnearbyplaces->where('government', $city);
            $hotelnearbyplaces = $hotelnearbyplaces->where('government', $city);
        }
        $restaurantnearbyplaces = $restaurantnearbyplaces->take($this->numberofRecords)->get();
        $tripnearbyplaces = $tripnearbyplaces->take($this->numberofRecords)->get();
        $hotelnearbyplaces = $hotelnearbyplaces->take($this->numberofRecords)->get();

        return $this->returnData(
            "nearbyplaces",
            [
                'hotels' => $hotelnearbyplaces,
                'restaurant' => $restaurantnearbyplaces,
                'trip' => $tripnearbyplaces
            ]
            ,'data Found'
        );
    }
    /*end function that send nearbyplaces*/

    /*start function that retrieve review that belong to nearbyplaces*/
    public function getReviewNearByPlaces($city){
        $tripwithreview=Trip::has('reviews')->with('reviews.user');
        $restaurantwithreview=Restaurant::has('reviews')->with('reviews.user');
        $hotelwithreview=Hotel::has('reviews')->with('reviews.user');

        if ($city !== 'null') {
            $restaurantwithreview = $restaurantwithreview->where('government', $city);
            $tripwithreview = $tripwithreview->where('government', $city);
            $hotelwithreview = $hotelwithreview->where('government', $city);

        }

        $tripwithreview = $tripwithreview->take($this->numberofRecords)->get();
        $restaurantwithreview = $restaurantwithreview->take($this->numberofRecords)->get();
        $hotelwithreview = $hotelwithreview->take($this->numberofRecords)->get();


        //start extract reviews from $tripwithreview
        $tripreview = $this->getReview($tripwithreview);

        //start extract reviews from $restaurantwithreview
        $restaurantreview = $this->getReview($restaurantwithreview);

        //start extract reviews from $hotelwithreview
        $hotelreview = $this->getReview($hotelwithreview);

        return $this->returnData(
            "reviews",
            [
                'tripreview' => array_slice($tripreview, 0, 2),
                'restaurantreview' => array_slice($restaurantreview, 0, 2),
                'hotelreview' => array_slice($hotelreview, 0, 2)
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
                'tripreview' => array_slice($tripreview, 0, 2),
                'restaurantreview' => array_slice($restaurantreview, 0, 2),
                'hotelreview' => array_slice($hotelreview, 0, 2)
            ]
            ,'Data Found'
        );
    }
    /*end function that retrieve review that belong to  top attractions*/


    /*start function that send offers*/
    public function getOffers(){
        $hotelOffers=Hotel::where('discount','<>','null')->take($this->numberofRecords)->get();
        $restaurantOffers=Restaurant::where('discount','<>','null')->take($this->numberofRecords)->get();
        $tripOffers=Trip::where('discount','<>','null')->take($this->numberofRecords)->get();

        return $this->returnData(
            "topAttractions",
            [
                'hotels' => $hotelOffers,
                'restaurants' => $restaurantOffers,
                'trips' => $tripOffers
            ]
            ,'Data Found'
        );
    }
    /*end function that send offers*/

    /*start function that retrieve review that belong to offers*/
    public function getReviewOffers(){
        $tripwithreview=Trip::where('discount','<>','null')->has('reviews')->with('reviews.user')->get();
        $restaurantwithreview=Restaurant::where('discount','<>','null')->has('reviews')->with('reviews.user')->get();
        $hotelwithreview=Hotel::where('discount','<>','null')->has('reviews')->with('reviews.user')->get();

        //start extract reviews from $tripwithreview
        $tripreview = $this->getReview($tripwithreview);

        //start extract reviews from $restaurantwithreview
        $restaurantreview = $this->getReview($restaurantwithreview);

        //start extract reviews from $hotelwithreview
        $hotelreview = $this->getReview($hotelwithreview);

        return $this->returnData(
            "reviews",
            [
                'tripreview' => array_slice($tripreview, 0, 2),
                'restaurantreview' => array_slice($restaurantreview, 0, 2),
                'hotelreview' => array_slice($hotelreview, 0, 2)
            ]
            ,'Data Found'
        );
    }
    /*end function that retrieve review that belong to  offers*/


    /*start function that get review from passed object*/
    public function getReview($passedObject){

        $review=[];
        foreach($passedObject as $bject) {
            $review = array_merge($review, $bject->reviews->toArray());
        }
        return $review;
    }
    /*end function that get review from passed object*/


    /*start function that get review from passed object*/
    public function getModifiedReview($passedObject){

        $review=[];
        foreach($passedObject->reviews as $bject) {
            array_push($review,  $bject);
        }
        return $review;
    }
    /*end function that get review from passed object*/




    /*start testing function that insert review*/
    public function store(Request $request){
        $object;
        $hotel=Hotel::where(["name"=>$request['object']['name'] , "government"=>$request['object']['government']])->first();
        $restaurant=Restaurant::where(["name"=>$request['object']['name'] , "government"=>$request['object']['government']])->first();
        $trip=Trip::where(["name"=>$request['object']['name'] , "government"=>$request['object']['government']])->first();
        //return $request;

        if($trip){
            $object=$trip;
        }
        else if($restaurant){
            $object=$restaurant;
        }
        else{
            $object= $hotel;
        }

        $comment = new Review();
        $comment->review = $request->review;
        $comment->user_id=$request->userID;
        $object->reviews()->save($comment);
        $object=$object->reviews()->with('user')->latest()->first();
       // $object=$this->getReview($)
        return $this->returnData("reviews", $object,'comment Inserted successuflly',200);

    }
    /*end testing function that insert review*/


    /*start function that get review by id*/
    public function reviewById(Request $request){
        $object;
        $hotel=Hotel::where(["name"=>$request['name'] , "government"=>$request['government']])->with('reviews.user')->first();
        $restaurant=Restaurant::where(["name"=>$request['name'] , "government"=>$request['government']])->with('reviews.user')->first();
        $trip=Trip::where(["name"=>$request['name'] , "government"=>$request['government']])->with('reviews.user')->first();
        //return $request;

        if($trip){
            $object=$trip;
        }
        else if($restaurant){
            $object=$restaurant;
        }
        else{
            $object= $hotel;
        }
       // return $object;
        $object=$this->getModifiedReview($object);
        return $this->returnData("reviews", $object,'Data Found',200);
    }
    /*end function that get review by id*/

}
