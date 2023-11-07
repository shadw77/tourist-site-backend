<?php

namespace App\Notifications;
use App\Models\UserOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;

class OrderPlacedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(UserOrder $order)
    {
        $this->order = $order;
    }
    public function toDatabase($notifiable)
    {
        return [
            'order_id' => $this->order->id,
            'service_id' => $this->order->service_id,
            'service_type' => $this->order->service_type,
        ];
    }
    // public function toDatabase($notifiable)
    // {
    //     return new DatabaseMessage([
    //         'order_id' => $this->order->id,
    //         'service_id' => $this->order->service_id,
    //         'service_type' => $this->order->service_type,
    //         'message' => 'A new order has been placed.',
    //     ]);
    // }

    // public function toBroadcast($notifiable)
    // {
    //     return new BroadcastMessage([
    //         'order_id' => $this->order->id,
    //         'message' => 'A new order has been placed.',
    //     ]);
    // }
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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
    //         'order_id' => $this->order->id,
    //         'service_id' => $this->order->service_id,
    //         'service_type' => $this->order->service_type,
    //     ];
    // }
}
