<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;
use App\Http\Resources\DestinationResource;
use Couchbase\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Ramsey\Collection\Collection;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $destinations = Destination::with('images')->get();
        return $destinations;
    }

    public function getDestinations()
{
    $sort = request()->get('sort');
    
    if ($sort == 'rating') {
        $destinations = Destination::orderBy('rating', 'desc')->get();
    } else {
        $destinations = Destination::all();
    }
    
    return $destinations;
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
            "name" => "required|max:255", 
            "creator_id" => "required",
            "thumbnail"=>"required"
        ]); 
    
        if ($validator->fails()) {
            return response($validator->errors()->all(), 422);
        }

       $destination = Destination::create($request->all());
    $destination->user->creator_id = Auth::id();
       $destination->save();
    
        return (new DestinationResource($destination))->response()->setStatusCode(201);
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function show(Destination $destination)
    {
        //
        return new DestinationResource($destination);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Destination $destination)
    {
        //

        $validator = Validator::make($request->all(), [
            "name" => "required|max:255",
            "thumbnail" => "required",
        ]);
     
        if ($validator->fails()) {
            return response($validator->errors()->all(), 422);
        }
    
        $destination->update($request->all());
    
        return (new DestinationResource($destination))->response()->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function destroy(Destination $destination)
    {
        $destination->delete();
        return response()->json(['message' => 'Restaurant deleted successfully'], 204);
    }
}