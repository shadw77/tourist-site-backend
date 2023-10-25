<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DestinationImage;
use App\Models\User;
use App\Models\Review;

class Destination extends Model
{
    use HasFactory;

    protected $table="destinations";

    protected $fillable = [
        'name',
        'description',
        'thumbnail',
        'creator_id'
    ];

    //relation destination with DestinationImage
    public function image()
    {
        return $this->hasMany(DestinationImage::class,"destination_id");
    }

    //relation destination with user
    public function user()
    {
        return $this->belongsToMany(User::class,"user_destination","destination_id","user_id");
    }

    //relation Destination with Review
    public function review()
    {
        return $this->hasMany(Review::class,"destination_id");
    }


    //relation destination with vendors
    public function vendor()
    {
        return $this->belongsTo(User::class,"creator_id");
    }

}
