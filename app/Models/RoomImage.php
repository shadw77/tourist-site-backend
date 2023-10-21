<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Room;

class RoomImage extends Model
{
    use HasFactory;

    protected $table="room_images";

    protected $fillable = [
        'image','hotel_id'
    ];

    //relation room image with hotel
    public function hotel()
    {
        return $this->belongsTo(Room::class,"room_id");
    }

}
