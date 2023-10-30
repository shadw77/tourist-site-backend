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
use App\Http\Resources\UserOrderResource;



class UserOrderController extends Controller
{
    
    public function index()
    {
        $orders = UserOrder::all();
        return UserOrderResource::collection($orders);
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
    
        $hotel = Hotel::find($validatedData['hotel_id']);
        $user->orders()->attach($hotel);
    
        $trip = Trip::find($validatedData['trip_id']);
        $user->orders()->attach($trip);
    
        $restaurant = Restaurant::find($validatedData['restaurant_id']);
        $user->orders()->attach($restaurant);

        $destination = Destination::find($validatedData['destination_id']);
        $user->orders()->attach($destination);
        
    
        return new UserOrderResource($user->orders());
    
    }

  
    public function show(UserOrder $userOrder)
    {
        $order = UserOrder::find($id);
        return new UserOrderResource($order);
    }

  
    public function update(Request $request, UserOrder $userOrder)
    {
        $order->update($request->all());
        return new UserOrderResource($order);
    }

    public function destroy(UserOrder $userOrder)
    {
        $order = UserOrder::find($id);
        $order->delete();
        return response()->json(['message' => 'Order deleted successfully']);    }
}

