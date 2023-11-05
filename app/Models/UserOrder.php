<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'service_id', 'service_type','amount','quantity'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->morphTo();
    }

}
