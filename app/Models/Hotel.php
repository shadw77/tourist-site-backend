<?php

namespace App\Models;
use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Room;
use App\Models\Review;

class Hotel extends Model
{
    use HasFactory;

    protected $table="hotels";


    protected $fillable = [
        'name','street','government','description','thumbnail','rating','creator_id'
    ];

    //relation Hotel with HotelImage
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function orders()
    {
        return $this->morphToMany(User::class, 'service', 'user_order')
            ->withTimestamps();
    }


    //relation Hotel with user
    // public function user()
    // {
    //     return $this->belongsToMany(User::class,"user_hotels","hotel_id","user_id");
    // }


    //relation Hotel with room
    public function room()
    {
        return $this->hasMany(Room::class,"hotel_id");
    }

    //relation Hotel with Review
    public function reviews()
    {
        return $this->morphMany('App\Models\Review', 'reviewable');
    }

    //relation hotels with vendors
    public function vendor()
    {
        return $this->belongsTo(User::class,"creator_id");
    }

}
