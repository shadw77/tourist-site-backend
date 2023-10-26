<?php

namespace App\Models;
namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Hotel;
use App\Models\Image;

class Room extends Model
{
    use HasFactory;

    protected $table="rooms";

    protected $fillable = [
        'type','street','description','thumbnail','hotel_id'
    ];

    //relation room with hotel
    public function hotel()
    {
        return $this->belongsTo(Hotel::class,"hotel_id");
    }


    //relation hotel with  room image
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

}
