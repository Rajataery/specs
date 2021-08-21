<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class inhousebooking extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
       $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        //dd($this->data);
        return (new MailMessage)
        ->subject("New booking successully added")
        ->greeting('Hi,')
        ->line('We have new booking for '.ucwords($this->data['name']))
        ->line("Email: ".$this->data['email'])
        ->line("Address: ".$this->data['address'])
        ->line("Phone Number: ".$this->data['phone'])
        ->line("Busisness Name: ".$this->data['business_name'])
        ->line("Participants: ".$this->data['participants'])
        ->line("Price: ".$this->data['price'])
        ->line("Payment Status: ".$this->data['payment_status'])
        ->line('Thank you!');
    }

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
