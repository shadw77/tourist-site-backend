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
use App\Notifications\OrderPlacedNotification;
use Illuminate\Support\Facades\Notification;
use Auth;
use Log;

class UserOrderController extends Controller
{
    public function checkout(Request $request)
    {
        $user = Auth::user();
        $cartItems = $request->input('cartProducts');

        foreach ($cartItems as $cartItem) {        
            $totalAmount = 0;            
            $totalAmount += $cartItem['quantity'] *$cartItem['item']['cost'];;
            $service_id = $cartItem['item']['id'];
            $service_type  = $cartItem['type'];
            if($cartItem['item']['discount']){
                $totalAmount-=$cartItem['item']['discount'];
            }

            $order = new UserOrder([
                'amount' => $totalAmount,
                'service_id'=>$service_id,
                'service_type'=>$service_type
            ]);

            $user->orders()->save($order);

            // Log::info('My Cart: ' . $cartItem['quantity']);
        }


        return response()->json(['message' => 'Order placed successfully'], 200);
    }

    public function index(Request $request)

    {
        if($request->query('userId')){
            $userId = $request->query('userId');
            $orders = UserOrder::where('user_id', $userId)->get();
            return UserOrderResource::collection($orders);
        }
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

        $order = new UserOrder();
        if($request->get('service_type') == "Hotel"){
            $hotel = Hotel::find($request->get('service_id'));
            $order->service_id = $hotel->id;
             $order->service()->associate($hotel);
            $user->orders()->save($order);
            $hotel->orders()->save($order);
            $creator = User::find($hotel->creator_id);
            $hotel->vendor->notify(new OrderPlacedNotification($order));
        }

        elseif($request->get('service_type') == 'Trip'){
             $trip = Trip::find($request->get('service_id'));
             $order->service_id = $trip->id;
             $order->service()->associate($trip);
             $user->orders()->save($order);    
        }
        elseif($request->get('service_type') == 'Destination'){  
            $destination = Destination::find($request->get('service_id'));
            $order->service_id = $destination->id;
            $order->service()->associate($destination);
            $user->orders()->save($order);  
        }
        elseif($request->get('service_type') == 'Restaurent'){  
            $restaurant = Restaurant::find($request->get('service_id'));
            $order->service_id = $restaurant->id;
            $order->service()->associate($restaurant);
            $user->orders()->save($order);       
           }
        //    $user->notify(new OrderPlacedNotification($order));
        return $order;
        // return new UserOrderResource($user->orders);
    
    }
    public function getNotifications()
    {
        $user = User::all();
        $notifications = $user->unreadNotifications;
        return response()->json(['notifications' => $notifications]);
    }

    public function markNotificationAsRead(Request $request)
    {
        $user = Auth::user(); 
        $notificationId = $request->input('notification_id');

        $notification = $user->notifications()->where('id', $notificationId)->first();
        if ($notification) {
            $notification->markAsRead();
            return response()->json(['message' => 'Notification marked as read']);
        } else {
            return response()->json(['error' => 'Notification not found'], 404);
        }
    }
    public function show($id)
    {
        $order = UserOrder::find($id);
        return new UserOrderResource($order);
    }
    
 
    public function showOrderDetails($id)
{ 
    $order = UserOrder::find($id);

    switch ($order->service_type) {
        case 'Trip':
            $serviceDetails = Trip::find($order->service_id);
            break;
        case 'Hotel':
            $serviceDetails = Hotel::find($order->service_id);
            break;
        case 'Destination':
            $serviceDetails = Destination::find($order->service_id);
            break;
        case 'Restaurant':
            $serviceDetails = Restaurant::find($order->service_id);
            break;
        default:
            $serviceDetails = null; 
            break;
    }
    return response()->json([
        'order' => $order,
        'service_details' => $serviceDetails,
    ]);
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

