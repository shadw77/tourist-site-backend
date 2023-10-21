<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RestaurantImage;
use App\Models\User;
use App\Models\Review;

class Restaurant extends Model
{
    use HasFactory;

    protected $table="restaurants";


    protected $fillable = [
        'name','email','street','government','description','phone','thumbnail','creator_id'
    ];


    //relation Restaurant with RestaurantImage
    public function image()
    {
        return $this->hasMany(RestaurantImage::class,"destination_id");
    }

    //relation Restaurant with user
    public function user()
    {
        return $this->belongsToMany(User::class,"user_restaurants","restaurant_id","user_id");
    }

    //relation Restaurant with Review
    public function review()
    {
        return $this->hasMany(Review::class,"restaurant_id");
    }

    //relation Restaurant with vendors
    public function vendor()
    {
        return $this->belongsTo(User::class,"creator_id");
    }

}
