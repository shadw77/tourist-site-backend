<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\HotelImage;
use App\Models\User;
use App\Models\Room;
use App\Models\Review;

class Hotel extends Model
{
    use HasFactory;

    protected $table="hotels";


    protected $fillable = [
        'name','street','government','description','thumbnail','creator_id'
    ];

    //relation Hotel with HotelImage
    public function image()
    {
        return $this->hasMany(HotelImage::class,"hotel_id");
    }

    //relation Hotel with user
    public function user()
    {
        return $this->belongsToMany(User::class,"user_hotels","hotel_id","user_id");
    }


    //relation Hotel with room
    public function room()
    {
        return $this->hasMany(Room::class,"hotel_id");
    }

    //relation Hotel with Review
    public function review()
    {
        return $this->hasMany(Review::class,"hotel_id");
    }

    //relation hotels with vendors
    public function vendor()
    {
        return $this->belongsTo(User::class,"creator_id");
    }

}
