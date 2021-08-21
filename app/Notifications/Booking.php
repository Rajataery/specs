<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Course;
use App\Inhouse;


class Booking extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data,$complete_pass)
    {
        $this->data  = $data;
        $this->complete_pass  = $complete_pass;
        
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
        // dd($this->data_address);
        return (new MailMessage)
        ->subject("Booking done successfully")
        ->greeting('Hi,')
        ->line('You have successfully booked for Course')
        ->line("Course Name: ".$this->data['course_name'])
        ->line("Course Location: ".$this->data['address'])
        ->line("Course Date: ".$this->data['date'])
        ->line("Password: ".$this->complete_pass)
        ->line("Seats: ".$this->data['participants'])
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
