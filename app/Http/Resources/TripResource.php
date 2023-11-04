<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TripResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return[
            "id"=>$this->id,
            "name"=>$this->name,
            "government"=>$this->government,
            "duration"=>$this->duration,
            "cost"=>$this->cost,
            "description"=>$this->description,
            "rating"=>$this->rating,
            "thumbnail"=>$this->thumbnail,
            "discount"=>$this->discount,
            "creator_id"=>$this->creator_id,
            "images"=>$this->images,
            "reviews"=>$this->reviews,



        ];
        // return parent::toArray($request);
    }
}