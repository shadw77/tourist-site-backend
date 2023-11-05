<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Notification;

class UserOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'service_id', 'service_type','amount'
    ];

    protected $table="user_orders";
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->morphTo();
    }
    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable');
    }

}
