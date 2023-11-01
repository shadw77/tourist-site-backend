<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DestinationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        return[
            "id"=>$this->id,
            "name"=>$this->name,
            "description"=>$this->description,
            "thumbnail"=>$this->thumbnail,
            "creator_id"=>$this->creator_id,
            "images"=>$this->images,
            "reviews"=>$this->reviews,
        ];
    }
}

