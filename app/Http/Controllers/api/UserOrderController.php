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
use App\Http\Services\FatoorahServices;
use App\Models\Transaction;
use Illuminate\Support\Facades\Redirect;


class UserOrderController extends Controller
{

    private $fatoorahServices;

    public function __construct(FatoorahServices $fatoorahServices)
    {
        $this->fatoorahServices = $fatoorahServices;
    }

    public function checkout(Request $request)
    {
        $user = Auth::user();
        $cartItems = $request->input('cartProducts');

        foreach ($cartItems as $cartItem) {
            $totalAmount = 0;
            $totalAmount += $cartItem['quantity'] *$cartItem['item']['cost'];;
            $service_id = $cartItem['item']['id'];
            $service_type  = $cartItem['type'];
            $quantity = $cartItem['quantity']; 
            if($cartItem['item']['discount']){
                $totalAmount-=$cartItem['item']['discount'];
            }

            $order = new UserOrder([
                'amount' => $totalAmount,
                'service_id'=>$service_id,
                'service_type'=>$service_type,
                'quantity'=>$quantity,
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
            //return UserOrderResource::collection($orders);
        }
        $orders = UserOrder::all();
        //return UserOrderResource::collection($orders);
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
    public function show(Request $request, $id)
    {
        $order = UserOrder::find($id);
       /// return new UserOrderResource($order);
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
        return response()->json(['message' => 'Order deleted successfully']);
    }


    public function confirm_order()
    {


        $order = UserOrder::latest()->first();
        $data = [
            'CustomerName' => $order->user->name,
            'NotificationOption' => 'LNK',
            'InvoiceValue' => $order->amount,
            'CustomerEmail' => $order->user->email,
            'CallBackUrl' => 'http://localhost:8000/api/callback',
            'ErrorUrl' => 'http://localhost:8000/api/error',
            'Language' => 'en',
            'DisplayCurrencyIso' => 'SAR'
        ];
        $info = $this->fatoorahServices->sendPayment($data);
        Transaction::create([
            'user_id' => $order->user->id,
            'invoiceid' => $info['Data']['InvoiceId']
        ]);

        return redirect($info['Data']['InvoiceURL']);
    }
    public function paymentCallBack(Request $request)
    {

        $data = [];
        $data['Key'] = $request->paymentId;
        $data['KeyType'] = 'paymentId';

        $paymentData = $this->fatoorahServices->getPaymentStatus($data);

        $usertrans = Transaction::where('invoiceid', $paymentData['Data']['InvoiceId'])->first();

        $usertrans->update(['paymentid' => $request->paymentId]);
        $redirectUrl = 'http://localhost:4200/';
        return Redirect::away($redirectUrl);
        /*$response=response()->json([
            'status' => 200,
            'mssg' => "User Has Successfully Logged",
            "userdata" => $user
        ]);
        $redirectUrl = 'http://localhost:4200/?response='.urlencode(json_encode($response));*/

    }
}

