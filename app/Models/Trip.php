<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image;
use App\Models\User;
use App\Models\Review;
use App\Models\Notify;

class Trip extends Model
{
    use HasFactory;

    protected $table="trips";


    protected $fillable = [
        'name','government','duration','cost','description','rating','thumbnail','creator_id','discount'
    ];


    //relation trip with TripImage
    public function images()
    {
        return  $this->morphMany(Image::class, 'imageable');
    }

    //relation trip with user
    // public function user()
    // {
    //     return $this->belongsToMany(User::class,"user_trips","trip_id","user_id");
    // }

    //relation Trip with Review
    public function reviews()
    {
        return $this->morphMany('App\Models\Review', 'reviewable');
    }

    public function orders()
    {
        return $this->morphToMany(User::class, 'service', 'user_order')
            ->withTimestamps();
    }
    public function timeSlot()
    {
        return $this->morphMany(TimeSlot::class, 'service');
    }

    //relation trip with vendors
    public function vendor()
    {
        return $this->belongsTo(User::class,"creator_id");
    }

    public function notify()
    {
        return $this->morphMany(Notify::class, 'notifiable');
    }
}
