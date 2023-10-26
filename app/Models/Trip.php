<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image;
use App\Models\User;
use App\Models\Review;

class Trip extends Model
{
    use HasFactory;

    protected $table="trips";


    protected $fillable = [
        'name','government','image','duration','cost','description','rating','thumbnail','creator_id'
    ];


    //relation trip with TripImage
    public function images()
    {
        return  $this->morphMany(Image::class, 'imageable');
    }

    //relation trip with user
    public function user()
    {
        return $this->belongsToMany(User::class,"user_trips","trip_id","user_id");
    }

    //relation Trip with Review
    public function reviews()
    {
        return $this->morphMany('App\Review', 'reviewable');
    }

    //relation trip with vendors
    public function vendor()
    {
        return $this->belongsTo(User::class,"creator_id");
    }


}
