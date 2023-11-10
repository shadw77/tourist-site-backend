<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Notification;
use App\Models\UserOrder;
use Illuminate\Notifications\Notifiable;
class OrderNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $order;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(UserOrder $order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
         return ['database'];
    }
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

    public function toDatabase($notifiable)
    {

        try {
            return [
                'order_id' => $this->order->id,
                //  'service_id' => $this->order->service_id,
                //  'service_type' => $this->order->service_type,
            ];
        } catch (\Exception $e) {
            Log::error('Notification error: ' . $e->getMessage());
        }
       
    }
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    // public function toArray($notifiable)
    // {
    //     return [
    //         'message' => 'A new order has been placed.'
    //     ];
    // }
}
