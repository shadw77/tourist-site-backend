<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use Illuminate\Http\Request;
use App\Http\Resources\TripResource;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $trips = Trip::with('images')->get();
        // $trip = Trip::create([
        //     'name'=> 'test'.rand(0,1999),
        //     'government'=> 'gtest'.rand(0,1999),
        //     'duration'=> 'dtest'.rand(0,1999),
        //     'cost'=> 'ctest'.rand(0,1999),
        //     'description'=> 'ddtest'.rand(0,1999),
        //     'rating'=> 'rtest'.rand(0,1999),
        //     'thumbnail'=> 'test'.rand(0,1999).'.png',
        //     'creator_id'=> 1


        // ])->images()->create([
        //     'image'=> 'images/url/image'.rand(0,1111).'.png',
        // ]);
       return TripResource::collection($trips);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            "government"=>'required',
            "duration"=>'required',
            "cost"=>'required',
            "description"=>'required',
            "rating"=>'required',
            "thumbnail"=>'required',
            "creator_id"=>'required',
        ]);
        $trip = Trip::create($request->all());
        return new TripResource($trip);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function show(Trip $trip)
    {
        //
        return new TripResource($trip);
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trip $trip)
    {
        //
        $trip->update($request->all());
        return new TripResource($trip);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trip $trip)
    {
        //
        $trip->delete();
        return 'deleted';
    }
}
