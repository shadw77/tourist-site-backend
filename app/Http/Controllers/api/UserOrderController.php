<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\UserOrder;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Trip;
use App\Models\Hotel;
use App\Models\Restaurant;
use App\Models\Destination;



class UserOrderController extends Controller
{
    
    public function index()
    {
        $orders = UserOrder::all();
        return response()->json(['orders' => $orders]);
}

  
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'hotel_id' => 'required|exists:hotels,id',
            'trip_id' => 'required|exists:trips,id',
            'restaurant_id' => 'required|exists:restaurants,id',
        ]);
    
        $user = User::find($validatedData['user_id']);
    
        // Create an order for a hotel
        $hotel = Hotel::find($validatedData['hotel_id']);
        $user->orders()->attach($hotel);
    
        // Create an order for a trip
        $trip = Trip::find($validatedData['trip_id']);
        $user->orders()->attach($trip);
    
        // Create an order for a restaurant
        $restaurant = Restaurant::find($validatedData['restaurant_id']);
        $user->orders()->attach($restaurant);

        // Create an order for a restaurant
        $destination = Destination::find($validatedData['destination_id']);
        $user->orders()->attach($destination);
        
    
        return response()->json(['message' => 'Order created successfully']);
    
    }

  
    public function show(UserOrder $userOrder)
    {
        $order = UserOrder::find($id);
        return response()->json(['order' => $order]);    
    }

  
    public function update(Request $request, UserOrder $userOrder)
    {
        //
    }

    public function destroy(UserOrder $userOrder)
    {
        $order = UserOrder::find($id);
        $order->delete();
        return response()->json(['message' => 'Order deleted successfully']);    }
}
