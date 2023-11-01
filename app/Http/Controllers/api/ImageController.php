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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
        $image = Image::create($request->all());
        if ($request->hasFile('path')) {
            $image = $request->file('path');
            $originalFilename = $image->getClientOriginalName();
            $imageName = time() . '_' . $originalFilename;
            $path = $image->storeAs('images', $imageName, 'hotel_uploads');
            $image->path = $imageName;
            $image->save();
        }
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
        if ($request->hasFile('path')) {
            $imageFile = $request->file('path');
            $originalFilename = $imageFile->getClientOriginalName();
             $imageName = time() . '_' . $originalFilename;
            // Save the new image file
            $imagePath = $imageFile->storeAs('images', $imageName, 'hotel_uploads');
            // Update the image model with the new image path
            $image->path = $imageName;
            $image->save();
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
