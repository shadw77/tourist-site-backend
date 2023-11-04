<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RestaurantImage;
use App\Models\User;
use App\Models\Review;
use App\Models\Image;


class Restaurant extends Model
{
    use HasFactory;

    protected $table="restaurants";


    protected $fillable = [
        'name','rating','email','street','government','description','phone','discount','cost','thumbnail','creator_id'
    ];


    //relation Restaurant with RestaurantImage
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    //relation Restaurant with user
    // public function user()
    // {
    //     return $this->belongsToMany(User::class,"user_restaurants","restaurant_id","user_id");
    // }

    //relation Restaurant with Review
    public function reviews()
    {
        return $this->morphMany('App\Models\Review', 'reviewable');
    }

    //relation Restaurant with vendors
    public function vendor()
    {
        return $this->belongsTo(User::class,"creator_id");
    }

    public function orders()
    {
        return $this->morphToMany(User::class, 'service', 'user_order')
            ->withTimestamps();
    }

}

