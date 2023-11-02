<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use Illuminate\Http\Request;
use App\Http\Resources\TripResource;
use Illuminate\Support\Facades\Storage;
class TripController extends Controller
{

    public function searchTrips(Request $request)
    {

        $query = Trip::query();
        $data = $request->input('search_service');        
        if($data){
            $query->whereRaw("name LIKE '%" .$data."%'");
        }
        return $query->get();
    }


    public function index(Request $request)
    {
        
        $trips = Trip::with('images')->get();
        // $keyword = $request->input('keyword');
        //         if ($request->filled('keyword')) {
        //     $keyword = $request->input('keyword');
        //     $Products = Product::where('name', 'LIKE', "%$keyword%")->where('availability', 'available')->paginate(3);
        // } else {
        //     $Products = Product::where('availability', 'available')->paginate(3);
        // }
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
        $file = $request->file("thumbnail");
        if($request->hasFile('thumbnail')){
            $originalName = $file->getClientOriginalName();
            $filenameonly= pathinfo($originalName,PATHINFO_FILENAME);
            $extenshion = $file->getClientOriginalExtension();
            $compic = str_replace('','_',$filenameonly).'-'.rand().'_'.time().'.'.$extenshion;
            $path = $file->storeAs('public/images/trips',$compic);      
            // Storage::disk('google')->put('GP Images', $file);
            $path = Storage::disk('google')->putFile('images/trips', $file, 'public');
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
        $trip->thumbnail=$compic;
        $trip->save();
        return new TripResource($trip);
    }}

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
