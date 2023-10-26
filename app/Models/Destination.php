<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DestinationImage;
use App\Models\User;
use App\Models\Review;
namespace App;

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
    public function images()
    {
        return $this->morphMany('App\Image', 'imageable');
    }

    //relation destination with user
    public function user()
    {
        return $this->belongsToMany(User::class,"user_destination","destination_id","user_id");
    }

    //relation Destination with Review
    public function reviews()
    {
        return $this->morphMany('App\Review', 'reviewable');
    }


    //relation destination with vendors
    public function vendor()
    {
        return $this->belongsTo(User::class,"creator_id");
    }

}
