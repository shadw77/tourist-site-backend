<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TimeSlotController extends Controller
{
    public function createTimeSlot(Request $request, $serviceType, $serviceId)
    {
        $data = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'available_slots' => 'required|integer',
        ]);

        $model = null;
        if ($serviceType === 'Trip') {
            $model = Trip::class;
        } elseif ($serviceType === 'Restaurent') {
            $model = Restaurant::class;
        } elseif ($serviceType === 'Hotel') {
            $model = Hotel::class;
        }

        if (!$model) {
            return response()->json(['error' => 'Invalid service type'], 400);
        }

        $service = $model::find($serviceId);

        if (!$service) {
            return response()->json(['error' => 'Service not found'], 404);
        }

        $timeSlot = new TimeSlot($data);
        $service->timeSlots()->save($timeSlot);

        return response()->json(['message' => 'Time slot created successfully']);
    }


    
public function updateServiceAvailability($serviceType, $serviceId)
{

    if ($serviceType === 'Trip') {
        $service = Trip::class;
    } elseif ($serviceType === 'Restaurent') {
        $service = Restaurant::class;
    } elseif ($serviceType === 'Hotel') {
        $service = Hotel::class;
    }
    $availableTimeSlots = TimeSlot::where('service_id', $serviceId)
        ->where('service_type', $serviceType)
        ->where('start_date', '>', now()) 
        ->where('available_slots', '>', 0)
        ->count();

    $service->update(['available' => $availableTimeSlots > 0]);
}


}
