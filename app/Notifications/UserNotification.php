<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;

class UserNotification extends Notification
{
    use Queueable;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return $this->getMessage();
    }

    public function getMessage()
    {
        return (new MailMessage)
            ->subject("You have Successfully Registered")
            ->greeting('Hi,')
            ->line("We will contact you shortly") 
            ->line("Email ".$this->data->email) 
            ->line("Guru Name ".$this->data->name) 
            ->line('Thank you')
            ->line(config('app.name') . ' Team')
            ->salutation(' ');
    }
}
