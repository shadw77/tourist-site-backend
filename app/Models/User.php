<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Destination;
use App\Models\Trip;
use App\Models\Restaurant;
use App\Models\Hotel;
use App\Models\Review;
use App\Models\Transaction;
use Tymon\JWTAuth\Contracts\JWTSubject;


class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table="users";

    protected $fillable = [
        'name','email','password','age','street','government','mobile','role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    //relation user with destination
    public function destination()
    {
        return $this->belongsToMany(Destination::class,"user_destinations","user_id","destination_id");
    }

    //relation user with trip
    public function trip()
    {
        return $this->belongsToMany(Trip::class,"user_trips","user_id","trip_id");
    }

    //relation user with Restaurant
    public function restaurant()
    {
        return $this->belongsToMany(Restaurant::class,"user_restaurants","user_id","restaurant_id");
    }

    //relation user with Hotel
    public function hotel()
    {
        return $this->belongsToMany(Hotel::class,"user_hotels","user_id","hotel_id");
    }

    //relation user with Review
    public function review()
    {
        return $this->hasMany(Review::class,"user_id");
    }


    //relation vendors with destiantion
    public function vendordestination()
    {
        return $this->hasMany(Destination::class,"creator_id");
    }


    //relation vendors with hotel
    public function vendorhotel()
    {
        return $this->hasMany(Hotel::class,"creator_id");
    }

    //relation vendor with Restaurant
    public function vendorrestaurant()
    {
        return $this->hasMany(Restaurant::class,"creator_id");
    }

    //relation vendor with Trip
    public function vendortrip()
    {
        return $this->hasMany(Trip::class,"creator_id");
    }

    //relation vendor with transaction
    public function transaction()
    {
        return $this->hasMany(Transaction::class,"user_id");
    }
}
