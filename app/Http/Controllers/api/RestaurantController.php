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
use App\Models\Image;
use App\Models\Review;
use Illuminate\Support\Facades\Storage;
class RestaurantController extends Controller
{
    public function searchRestaurants(Request $request)
    {
        $query = Restaurant::query();
        $data = $request->input('search_service');        

        if($data){
            $query->whereRaw("name LIKE '%" .$data."%'");
        }
        return $query->get();
    }

    public function index()
    {
        //
        $restaurants = Restaurant::paginate(3);
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
        $restaurant = Restaurant::create($request->all());
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $originalFilename = $image->getClientOriginalName();
            $imageName = time() . '_' . $originalFilename;
            $thumbnail = $image->storeAs('thumbnails', $imageName, 'restaurant_uploads');
            $restaurant->thumbnail = $imageName;
            $restaurant->save();
        }
         
        if ($request->hasFile('images')) {
            $uploadedImages = $request->file('images');
            foreach ($uploadedImages as $uploadedImage) {
                $originalFilename = $uploadedImage->getClientOriginalName();
                $imageName = time() . '_' . $originalFilename;
                $path = $uploadedImage->storeAs('images', $imageName, 'restaurant_uploads');
                 
                $image = new Image(['image' => $imageName]);
                
                $restaurant->images()->save($image);
            }
        }
    
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
        return (new RestaurantResource($restaurant))->response()->setStatusCode(200);
    }
    public function getDiscountedRestaurant()
    {
        $restaurant = Restaurant::whereNotNull('discount')
                     ->orWhere('discount', '>', 0)
                     ->get();
        return response()->json($restaurant);
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
            "email" => "required|email",
            "rating" => "required",
            "street" => "required|max:255",
            "government" => "required|max:255",
            "phone" => "required",
            "thumbnail" => "required",
        ]);
        
        if ($validator->fails()) {
            return response($validator->errors()->all(), 422);
        }
    
       
        // $restaurant->creator_id = Auth::id();
        // $restaurant->user->creator_id = Auth::id();
        // $restaurant->update();

         $restaurant->fill($request->all());
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $originalFilename = $image->getClientOriginalName();
            $imageName = time() . '_' . $originalFilename;
            $thumbnail = $image->storeAs('thumbnails', $imageName, 'restaurant_uploads');
             $restaurant->thumbnail = $imageName;
        }
         
        if ($request->hasFile('images')) {
            $uploadedImages = $request->file('images');
            foreach ($uploadedImages as $uploadedImage) {
                $originalFilename = $uploadedImage->getClientOriginalName();
                $imageName = time() . '_' . $originalFilename;
                $path = $uploadedImage->storeAs('images', $imageName, 'restaurant_uploads');
    
                 $image = new Image(['image' => $imageName]);
                $restaurant->images()->save($image);
            }
        }
        $restaurant->save();
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
        $restaurant->images()->delete();
        $restaurant->reviews()->delete();
           $restaurant->delete();
          return response()->json(['message' => 'Restaurant deleted successfully'], 204);
      
    }
}
