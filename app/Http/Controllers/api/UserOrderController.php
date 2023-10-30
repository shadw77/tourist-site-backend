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
            'service_type'=>'required',
            'service_id'=>'required'

        ]);
        $user = User::find($validatedData['user_id']);

        if($request->get('service_type') == "Hotel"){
            $hotel = Hotel::find($request->get('service_id'));
            $order = new UserOrder();
            $order->service_id = $hotel->id;
            $order->service()->associate($hotel);
            $user->orders()->save($order);

        }
        elseif($request->get('service_type') == 'Trip'){
             $trip = Trip::find($request->get('service_id'));
             $order = new UserOrder();
             $order->service_id = $trip->id;
             $order->service()->associate($trip);
             $user->orders()->save($order);    
        }
        elseif($request->get('service_type') == 'Destination'){  
            $destination = Destination::find($request->get('service_id'));
            $order = new UserOrder();
            $order->service_id = $destination->id;
            $order->service()->associate($destination);
            $user->orders()->save($order);  
        }
        elseif($request->get('service_type') == 'Restaurent'){  
            $restaurant = Restaurant::find($request->get('service_id'));
            $order = new UserOrder();
            $order->service_id = $restaurant->id;
            $order->service()->associate($restaurant);
            $user->orders()->save($order);          }

        
        return new UserOrderResource($user->orders);
    
    }

    public function show(Request $request, $id)
    {
        $order = UserOrder::find($id);
        return new UserOrderResource($order);
    }
    
 
    
    public function update(Request $request, $id)
    {
        $order = UserOrder::find($id);
        $order->update($request->all());
        return new UserOrderResource($order);
    }

    public function destroy(Request $request, $id)
    {
        $order = UserOrder::find($id);
        $order->delete();
        return response()->json(['message' => 'Order deleted successfully']);    }
}

