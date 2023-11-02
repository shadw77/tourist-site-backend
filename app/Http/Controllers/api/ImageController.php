<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //  dd($request->all());
        $image = new Image();
        $image->imageable_id = $request->input('imageable_id');
        $image->imageable_type = $request->input('imageable_type');
       
          if ($request->hasFile('image')) {
               $imageFile = $request->file('image');
               $originalFilename = $imageFile->getClientOriginalName();
                 $imageName = time() . '_' . $originalFilename;
                if($image->imageable_type=="Trip"){
                    $imagePath = $imageFile->storeAs('images', $imageName, 'trip_uploads');
                    $image->image = $imageName;
                    $image->save();
                }

            }
            $image->save();
           return $image;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function updateImage(Request $request, Image $image)
    {
        $validatedData = $request->validate([
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $originalFilename = $imageFile->getClientOriginalName();
             $imageName = time() . '_' . $originalFilename;
             if( $image->imageable_type=="Hotel"){
            $imagePath = $imageFile->storeAs('images', $imageName, 'hotel_uploads');
            $image->image = $imageName;
            $image->save();
             }
        
            if($image->imageable_type=="Trip"){
                $imagePath = $imageFile->storeAs('images', $imageName, 'trip_uploads');
                $image->image = $imageName;
                $image->save();
            }
            if($image->imageable_type=="Restaurant"){
                $imagePath = $imageFile->storeAs('images', $imageName, 'restaurant_uploads');
                $image->image = $imageName;
                $image->save();
            }
        }
    //    return $image;

        return response()->json(['message' => 'Image updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        $image->delete();
        return response("Deleted", 204);
    }
}
