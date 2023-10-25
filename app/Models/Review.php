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
        'review','reviewable_id','reviewable_type'
    ];

    public function reviewable()
    {
        return $this->morphTo();
    }
}
