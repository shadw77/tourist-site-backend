<?php

namespace App\Http\Controllers\api;
use App\Http\Resources\HotelResource;
use App\Models\Image;
use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Ramsey\Collection\Collection;
use App\Http\Requests\StoreHotelRequest;
use Illuminate\Support\Facades\Storage;

class HotelController extends Controller
{
    public function searchHotels(Request $request)
    {
        $query = Hotel::query();
        $data = $request->input('search_service');        

        if($data){
            $query->whereRaw("name LIKE '%" .$data."%'");
        }
        return $query->get();
    }

    public function index()
     {    
          $hotels=Hotel::paginate();
          return HotelResource::collection($hotels);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   public function store(Request $request)
    {
       
        $validator = Validator::make($request->all(), [
            // 'name' => 'required|min:10',
            // 'street' => 'required',
            // 'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            // 'images.*' => 'required|image|mimes:jpeg,png,jpg|max:20'
        ]);
    
        if ($validator->fails()) {
            return response($validator->errors()->all(), 422);
        }
        $hotel = Hotel::create($request->all());
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $originalFilename = $image->getClientOriginalName();
            $imageName = time() . '_' . $originalFilename;
            $thumbnail = $image->storeAs('thumbnails', $imageName, 'hotel_uploads');
            $hotel->thumbnail = $imageName;
            $hotel->save();
        }
         
        if ($request->hasFile('images')) {
            $uploadedImages = $request->file('images');
            foreach ($uploadedImages as $uploadedImage) {
                $originalFilename = $uploadedImage->getClientOriginalName();
                $imageName = time() . '_' . $originalFilename;
                $path = $uploadedImage->storeAs('images', $imageName, 'hotel_uploads');
                 
                $image = new Image(['image' => $imageName]);
                
                $hotel->images()->save($image);
            }
        }
       
       return (new HotelResource($hotel))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function show(Hotel $hotel)
    {
     return (new HotelResource($hotel))->response()->setStatusCode(201);
    }

    public function update(Request $request, Hotel $hotel)
    {
        
        $validator = Validator::make($request->all(), [
            // 'name' => 'required|min:10',
            // 'street' => 'required',
            // 'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            // 'images.*' => 'required|image|mimes:jpeg,png,jpg|max:20'
        ]);
    
        if ($validator->fails()) {
            return response($validator->errors()->all(), 422);
        }
        $hotel->fill($request->all());
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $originalFilename = $image->getClientOriginalName();
            $imageName = time() . '_' . $originalFilename;
            $thumbnail = $image->storeAs('thumbnails', $imageName, 'hotel_uploads');
            $hotel->thumbnail = $imageName;
        }
         
        if ($request->hasFile('images')) {
            $uploadedImages = $request->file('images');
            foreach ($uploadedImages as $uploadedImage) {
                $originalFilename = $uploadedImage->getClientOriginalName();
                $imageName = time() . '_' . $originalFilename;
                $path = $uploadedImage->storeAs('images', $imageName, 'hotel_uploads');
    
                 $image = new Image(['image' => $imageName]);
                $hotel->images()->save($image);
            }
        }
        $hotel->save();
        
        return (new HotelResource($hotel))->response()->setStatusCode(200);
    }


    public function destroy(Hotel $hotel)
    {
         $hotel->delete();
         return response("Deleted", 204);
    }
}