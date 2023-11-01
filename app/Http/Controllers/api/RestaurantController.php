<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

use App\Models\User;
use Couchbase\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Ramsey\Collection\Collection;
use App\Http\Resources\RestaurantResource;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $restaurants = Restaurant::with('images')->get();
                return RestaurantResource::collection($restaurants);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {    
        //Validate the incoming request data
        $validator = Validator::make($request->all(), [
            "name" => "required|max:255", 
            "email" => "required|email|unique:restaurants", 
            "rating"=>"required",
            "street" => "required|max:255", 
            "government" => "required|max:255", 
            "phone" => "required", 
            "creator_id" => "required",
            "thumbnail"=>"required"
        ]); 
    
        if ($validator->fails()) {
            return response($validator->errors()->all(), 422);
        }
    
        // Create a new restaurant instance and set the creator_id
       $restaurant = Restaurant::create($request->all());
        // dd(Auth::id());
    //    $restaurant->creator_id = Auth::id();  
    $restaurant->user->creator_id = Auth::id();
       $restaurant->save();
    
        return (new RestaurantResource($restaurant))->response()->setStatusCode(201);
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        //
        return new RestaurantResource($restaurant);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant)
     {   
        $validator = Validator::make($request->all(), [
            "name" => "required|max:255",
            "email" => Rule::unique('restaurants')->ignore($restaurant->email),
            "rating" => "required",
            "street" => "required|max:255",
            "government" => "required|max:255",
            "phone" => "required",
            "thumbnail" => "required",
        ]);
     
        if ($validator->fails()) {
            return response($validator->errors()->all(), 422);
        }
    
        $restaurant->update($request->all());
        // $restaurant->creator_id = Auth::id();
        // $restaurant->user->creator_id = Auth::id();
        // $restaurant->update();
        return (new RestaurantResource($restaurant))->response()->setStatusCode(200);
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
           $restaurant->delete();
          return response()->json(['message' => 'Restaurant deleted successfully'], 204);
      
    }
}
