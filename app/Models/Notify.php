<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notify extends Model
{

    use HasFactory;
    protected $table='custom_notifications';
    protected $fillable = [
        'message','notifiable_id','notifiable_type','read','user_id'
    ];

    public function notifiable()
    {
        return $this->morphTo();
    }
}
