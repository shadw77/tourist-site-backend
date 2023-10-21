<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Destination;
use App\Models\Trip;
use App\Models\Restaurant;
use App\Models\Hotel;



class Review extends Model
{
    use HasFactory;

    protected $table="reviews";

    protected $fillable = [
        'comment','userid','destid','hotid','tripid','restid'
    ];

    //relation review with User
    public function user()
    {
        return $this->belongsTo(User::class,"user_id");
    }

    //relation review with Destination
    public function destination()
    {
        return $this->belongsTo(Destination::class,"destination_id");
    }

    //relation review with Hotel
    public function hotel()
    {
        return $this->belongsTo(Hotel::class,"hotel_id");
    }

    //relation review with Trip
    public function trip()
    {
        return $this->belongsTo(Trip::class,"trip_id");
    }


    //relation review with restaurant
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class,"restaurant_id");
    }
}
