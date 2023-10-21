<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Trip;


class TripImage extends Model
{
    use HasFactory;

    protected $table="trip_images";

    protected $fillable = [
        'image',
        'trip_id',
    ];

    //relation trip image with trip
    public function trip()
    {
        return $this->belongsTo(Trip::class,"trip_id");
    }
}
