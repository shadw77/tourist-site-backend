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

}
