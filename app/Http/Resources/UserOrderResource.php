<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserOrderResource extends JsonResource
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
            "user_id"=>$this->user_id,
            "service_id"=>$this->service_id,
            "service_type"=>$this->service_type,
            "amount"=>$this->amount,
            "service_name" => $this->service->name,
            "discount" => $this->service->discount,
            "quantity"=>$this->quantity,
            "service_thumbnail" => $this->service->thumbnail,
            "created_at"=>$this->created_at,

          
        ];
        // return parent::toArray($request);
    }
}
