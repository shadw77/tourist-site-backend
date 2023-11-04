<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\HotelImageResource;

class HotelResource extends JsonResource
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
        return [
            'id' => $this->id,
            'name' => $this->name,
            'street' => $this->street,
            'government' => $this->government,
            'description'=>$this->description,
            'thumbnail'=> $this->thumbnail,
            'discount'=> $this->discount,
            "cost"=>$this->cost,
            "creator_id"=>$this->creator_id,
            "images"=>$this->images,
            "reviews"=>$this->reviews,
        ];
    }

}
