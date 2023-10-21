<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Restaurant;

class RestaurantImage extends Model
{
    use HasFactory;

    protected $table="restaurant_images";

    protected $fillable = [
        'image',
        'destination_id',
    ];

    //relation restaurant image with restaurant
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class,"destination_id");
    }

}
