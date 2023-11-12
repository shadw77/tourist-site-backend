<?php

namespace App\Listeners;
use App\Events\EventOrder;
use App\Models\User;
use App\Models\Restaurant;
use App\Models\Trip;
use App\Models\Hotel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\userNotification;
use App\Models\Notify;

class OrderListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(EventOrder $event)
    {
        $order=$event->order;
        $user=$event->user;
        $service_type=$order->service_type;
        if($service_type=="Hotel"){
            $hotel=Hotel::where("id",$order->service_id)->first();
            $vendor=User::where("id",$hotel->creator_id)->first();
            if($vendor){
                $notify = new Notify();
                $notify->user_id = $user->id; 
                $notify->message ='Your Hotel has been placed';
                $notify->notifiable()->associate($hotel);
                $notify->save();
                $vendor->notify(new userNotification($order,$user));
              }
        }
        if($service_type=="Trip"){
            $trip=Trip::where("id",$order->service_id)->first();
            $vendor=User::where("id",$trip->creator_id)->first();
            if($vendor){
                $notify = new Notify();
                $notify->user_id = $user->id; 
                $notify->message ='Your Trip has been placed';
                $notify->notifiable()->associate($trip);
                $notify->save();
                $vendor->notify(new userNotification($order,$user));
              }
        }
        if($service_type=="Restaurant"){
            $restaurant=Restaurant::where("id",$order->service_id)->first();
            $vendor=User::where("id",$restaurant->creator_id)->first();
            if($vendor){
                $notify = new Notify();
                $notify->user_id = $user->id; 
                $notify->message ='Your Restaurant has been placed';
                $notify->notifiable()->associate($restaurant);
                $notify->save();
                $vendor->notify(new userNotification($order,$user));
              }
        }
      
    }
}
