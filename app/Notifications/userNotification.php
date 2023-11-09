<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;
use App\Models\UserOrder;
use App\Models\Hotel;
class userNotification extends Notification
{
    use Queueable;
   protected  $order;
   protected $user;
   protected $hotel;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(UserOrder $order,User $user)
    {
        $this->order=$order;
        $this->user=$user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }
    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->greeting("Hello {$this->user->name}")
                    ->subject("order Placed")
                    ->line("thanks for use website")
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our website!');
    }
    // public function toDatabase(object $notifiable)
    // {
    //    return [
    //         //    "subject"=>("{$this->user->name} make order # {$this->order->id} for the hotel {$this->hotel->name}"),
    //         "title"=>"hello"     
    //     ];
    // }
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
