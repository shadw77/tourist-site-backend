<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Hotel;


class HotelImage extends Model
{
    use HasFactory;

    protected $table="hotel_images";

    protected $fillable = [
        'image',
        'hotel_id',
    ];

    //relation hotel image with Hotel
    public function Hotel()
    {
        return $this->belongsTo(Hotel::class,"hotel_id");
    }

}
