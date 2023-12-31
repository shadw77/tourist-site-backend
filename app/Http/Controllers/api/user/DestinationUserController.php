<?php

namespace App\Http\Controllers\destination;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Image;
use App\Http\Requests\destinationRequest;

class DestinationUserController extends Controller
{
    public function index()
    {

        // $destinations = Destination::with('images')->get();
        $destinations = Destination::with('images')->paginate(4);
        
        return DestinationResource::collection($destinations);
    }

    public function getDestinations()
    {
        $sort = request()->get('sort');

        if ($sort == 'rating') {
            $destinations = Destination::orderBy('rating', 'desc')->get();
            return $destinations;


        } else {
            $destinations = Destination::all();
            return $destinations;

        }
    }

    public function searchDestinations(Request $request)
    {
        $query = Destination::query();
        $data = $request->input('search_service');

        if($data){
            $query->whereRaw("name LIKE '%" .$data."%'");
        }
        return $query->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $rules=[
            'name'          => 'required|string',
            'description'   => 'required|string|max:900',
             'creator_id'    => 'required|numeric|exists:users,id',
        ];

        $messages=[
            "required"          =>  "This Field Is Required",
            "string"            =>  "This Field Must Be String",
            "max"               =>  "This Field Can not Exceed 900 Characters",
            "creator_id.exists" =>  "Creator Should Be Exist"
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return $this->returnError($validator->errors(), 400);
        }


        $destination=Destination::create($request->all());

        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $originalFilename = $image->getClientOriginalName();
            $imageName = time() . '_' . $originalFilename;
            $thumbnail = $image->storeAs('thumbnails', $imageName, 'destination_uploads');
            $destination->thumbnail = $imageName;
            $destination->save();
        }
        if ($request->hasFile('images')) {
            $uploadedImages = $request->file('images');
            foreach ($uploadedImages as $uploadedImage) {
                $originalFilename = $uploadedImage->getClientOriginalName();
                $imageName = time() . '_' . $originalFilename;
                $path = $uploadedImage->storeAs('images', $imageName, 'destination_uploads');

                $image = new Image(['image' => $imageName]);

                $destination->images()->save($image);
            }
        }


        return $this->returnSuccessMessage("Record Inserted Successfully","201");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $destination=Destination::with('images')->find($id);
        return $this->returnData('destination',$destination,'destination found');
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
        $rules=[
            'name'          => 'required|string',
            'description'   => 'required|string|max:900',
            'creator_id'    => 'required|numeric|exists:users,id',
        ];

        $messages=[
            "required"          =>  "This Field Is Required",
            "string"            =>  "This Field Must Be String",
            "max"               =>  "This Field Can not Exceed 900 Characters",
            "creator_id.exists" =>  "Creator Should Be Exist"
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return $this->returnError($validator->errors(), 400);
        }


        $destination->update($request->all());
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $originalFilename = $image->getClientOriginalName();
            $imageName = time() . '_' . $originalFilename;
            $thumbnail = $image->storeAs('thumbnails', $imageName, 'destination_uploads');
            $destination->thumbnail = $imageName;
            $destination->save();
        }
        if ($request->hasFile('images')) {
            $uploadedImages = $request->file('images');
            foreach ($uploadedImages as $uploadedImage) {
                $originalFilename = $uploadedImage->getClientOriginalName();
                $imageName = time() . '_' . $originalFilename;
                $path = $uploadedImage->storeAs('images', $imageName, 'destination_uploads');

                $image = new Image(['image' => $imageName]);

                $destination->images()->save($image);
            }
        }
        return $this->returnSuccessMessage("Record Updated Successfully","201");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function destroy(Destination $destination)
    {
        $destination->images()->delete();
        $destination->reviews()->delete();
        $destination->delete();
        return $this->returnSuccessMessage('destination deleted successfully',201);
    }
}
