<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            "email"=>$this->email,
            "password"=>$this->password,
            "street"=>$this->street,
            "mobile"=>$this->mobile,
            "role"=>$this->role,
        ];
        // return parent::toArray($request);
    }
}
