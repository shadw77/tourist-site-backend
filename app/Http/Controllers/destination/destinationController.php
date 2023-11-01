<?php

namespace App\Http\Controllers\destination;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\GeneralTrait;
use App\Models\Image;
use App\Http\Requests\destinationRequest;

class destinationController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $destinations=Destination::with('images')->get();
        return $this->returnData('destinations',$destinations,'destinations found');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*return $request;
        $validator= $request->validated();
        return $validator->errors();
        //$validator = Validator::make($request->all(), $request->rules(), $request->messages());

        */

        $rules=[
            'name'          => 'required|string',
            'description'   => 'required|string|max:255',
            'creator_id'    => 'required|numeric|exists:users,id',
        ];

        $messages=[
            "required"          =>  "This Field Is Required",
            "string"            =>  "This Field Must Be String",
            "max"               =>  "This Field Can not Exceed 255 Characters",
            "creator_id.exists" =>  "Creator Should Be Exist"
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return $this->returnError($validator->errors(), 400);
        }


        $destination=Destination::create($request->except('image'));
        foreach ($request->image as $index => $value) {
            $img = new Image();
            $img->image = $value;
            $destination->images()->save($img);
        }
        /*
        $filepath=null;
        if($request->has('image')){
            $file = $request->file('image');
            $filepath = $file->store('product', 'products');
        }*/
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
            'description'   => 'required|string|max:255',
            'creator_id'    => 'required|numeric|exists:users,id',
        ];

        $messages=[
            "required"          =>  "This Field Is Required",
            "string"            =>  "This Field Must Be String",
            "max"               =>  "This Field Can not Exceed 255 Characters",
            "creator_id.exists" =>  "Creator Should Be Exist"
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return $this->returnError($validator->errors(), 400);
        }


        $destination->update($request->except('image'));
        foreach ($request->image as $index => $value) {
            $img = new Image();
            $img->image = $value;
            $destination->images()->save($img);
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
        $destination->delete();
        return $this->returnSuccessMessage('destination deleted successfully',201);
    }
}
