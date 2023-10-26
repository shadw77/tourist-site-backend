<?php

namespace App\Http\Controllers\api;
use App\Http\Resources\HotelResource;
use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Ramsey\Collection\Collection;
use App\Http\Requests\StoreHotelRequest;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $hotels=Hotel::all();
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
            'name' => 'required|min:10',
            'street' => 'required',
        ]);

        if($validator->fails()){
            return response($validator->errors()->all(), 422);
        }

        $hotel=Hotel::create($request->all());
        // $hotel->creator_id = Auth::id();
        $hotel->save;
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hotel $hotel)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:10',
            'street' => 'required',
        ]);

        if($validator->fails()){
            return response($validator->errors()->all(), 422);
        } 
        $hotel->update($request->all());
         
        return (new HotelResource($hotel))->response()->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hotel $hotel)
    {
         $hotel->delete();
         return response("Deleted", 204);
    }
}
