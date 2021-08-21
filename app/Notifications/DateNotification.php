<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;

class DateNotification extends Notification
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
            ->subject("Guru Assign Date Himself")
            ->greeting('Hi,')
            ->line("Hello Dear Admin") 
            ->line("One of You guru assign date himself") 
            ->line("Details Are Mention in this mail") 
            ->line("Email ".$this->data['user']->email) 
            ->line("Guru Name ".$this->data['user']->name) 
            ->line("Course Name ".$this->data['date']['course']->course_name) 
            ->line("Start Date ".$this->data['date']->Date) 
            ->line('Thank you')
            ->line(config('app.name') . ' Team')
            ->salutation(' ');
    }
}
