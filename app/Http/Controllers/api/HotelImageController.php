<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\HotelImage;
use Illuminate\Http\Request;
use App\Http\Resources\HotelImageResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Ramsey\Collection\Collection;

class HotelImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new HotelImageResource(HotelImage::all());

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
            'image' => 'required',
        ]);

        if($validator->fails()){
            return response($validator->errors()->all(), 422);
        }

        $hotel=HotelImage::create($request->all());
        // $hotel->creator_id = Auth::id();
        $hotel->save;
        return (new HotelImageResource($hotel))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HotelImage  $hotelImage
     * @return \Illuminate\Http\Response
     */
    public function show(HotelImage $hotelImage)
    {
        
        return (new HotelImageResource($hotelImage))->response()->setStatusCode(201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HotelImage  $hotelImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HotelImage $hotelImage)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required',
        ]);

        if($validator->fails()){
            return response($validator->errors()->all(), 422);
        } 
        $hotelImage->update($request->all());
         
        return (new HotelImageResource($hotelImage))->response()->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HotelImage  $hotelImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(HotelImage $hotelImage)
    {
        
        $hotelImage->delete();
        return response("Deleted", 204);
    }
}
