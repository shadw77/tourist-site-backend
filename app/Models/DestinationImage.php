<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Destination;

class DestinationImage extends Model
{
    use HasFactory;

    protected $table="destination_images";

    protected $fillable = [
        'image',
        'destination_id',
    ];

    //relation destination image with destination
    public function destination()
    {
        return $this->belongsTo(Destination::class,"destination_id");
    }

}
