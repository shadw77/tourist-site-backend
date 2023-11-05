<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSlot extends Model
{
    protected $table = 'time_slot';

    use HasFactory;
    protected $fillable = ['service_id', 'service_type', 'start_date', 'end_date', 'available_slots'];
    
    public function service()
    {
        return $this->morphTo();
    }
}
