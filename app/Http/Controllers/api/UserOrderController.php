<?php

namespace App\Http\Controllers\api;
use App\Events\EventOrder;
use App\Http\Controllers\Controller;
use App\Models\UserOrder;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Trip;
use App\Models\Hotel;
use App\Models\Restaurant;
use App\Models\Destination;
use App\Http\Resources\UserOrderResource;
use App\Notifications\OrderNotification;
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
    public function userService(){
        $user = Auth::guard('api')->user();
        $hotels = Hotel::query()->get()->toArray();
        $trips = Trip::query()->get()->toArray();
        $restaurants = Restaurant::query()->get()->toArray();
    
        if ($user->role === "vendor") {
            $hotels = Hotel::query()->where('creator_id', $user->id)->get()->toArray();
            $trips = Trip::query()->where('creator_id', $user->id)->get()->toArray();
            $restaurants = Restaurant::query()->where('creator_id', $user->id)->get()->toArray();
        }
        // Add type property to each item
        foreach ($hotels as &$hotel) {
            $hotel['type'] = "Hotel";
        }
    
        foreach ($trips as &$trip) {
            $trip['type'] = "Trip";
        }
    
        foreach ($restaurants as &$restaurant) {
            $restaurant['type'] = "Restaurant";
        }
    
        // Merge the collections
       // Combine arrays into one
    $combinedArray = array_merge($hotels, $trips, $restaurants);

    // Return or use the combined array as needed
    return $combinedArray;
    }
    
    public function index(Request $request)

    {
         
        if($request->query('userId')){
            $userId = $request->query('userId');
            $orders = UserOrder::where('user_id', $userId)->get();
            //return UserOrderResource::collection($orders);
        }

        // $orders = UserOrder::all();
        $orders = UserOrder::orderBy('created_at', 'desc')->paginate(2); 
        return UserOrderResource::collection($orders);
    }
   public function allIndex(){
    $user = Auth::guard('api')->user();
    $user_id= $user->id;
    // $hotels = Hotel::query()->get()->toArray();
    // $trips = Trip::query()->get()->toArray();
    // $restaurants = Restaurant::query()->get()->toArray();
    $orders = UserOrder::whereHasMorph('service', [Restaurant::class, Trip::class, Hotel::class], function ($query) use ($user_id) {
        $query->where('creator_id', $user_id);
    })->get(); 
    return $orders;
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
             $order->amount=$request->get('amount');
             $order->service()->associate($hotel);
            $user->orders()->save($order);
            event(new EventOrder($order,$user,$hotel));
        }

        else if($request->get('service_type') === 'Trip'){
             $trip = Trip::find($request->get('service_id'));
             $order->service_id = $trip->id;
             $order->amount=$request->get('amount');
             $order->service()->associate($trip);
             $user->orders()->save($order);  
             event(new EventOrder($order,$user,$trip));  
        }
        else if($request->get('service_type') == 'Destination'){
            $destination = Destination::find($request->get('service_id'));
            $order->service_id = $destination->id;
            $order->amount=$request->get('amount');
            $order->service()->associate($destination);
            $user->orders()->save($order);  
        }
        else if($request->get('service_type') == 'Restaurent'){
            $restaurant = Restaurant::find($request->get('service_id'));
            $order->service_id = $restaurant->id;
            $order->service()->associate($restaurant);
            $user->orders()->save($order);  
            event(new EventOrder($order,$user,$restaurant));      
           }
          return $order;
        return new UserOrderResource($user->orders);

    }

   
    public function show(Request $request, $id)
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
            'invoiceid' => $info['Data']['InvoiceId'],
            'creator_id' => $order->service->creator_id

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

