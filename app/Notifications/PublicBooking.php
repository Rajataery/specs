<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Venue;
use App\Course;

class PublicBooking extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data, $seats)
    {
        $this->data  = $data;
        $this->seats = $seats;
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
        $Venue = Venue::where('id',$this->data->venue_id)->get();
        $course = Course::where('id',$this->data->course_id)->get();
        $venue_location =  $Venue[0]['location_name'];
        //dd();
        return (new MailMessage)
            ->subject("New ".ucwords($this->data->course_vendor). " booking ")
            ->greeting('Hi,')
            ->line('We have new booking for '.ucwords($this->data->course_vendor))
            ->line("Course Name: ".$this->data->event_title)
            ->line("Course Code: ".$course[0]['code'])
            ->line("Event Code: ".$this->data->event_code)
            ->line("Booked Seats : ".$this->seats)
            ->line("Venue : ".$venue_location)
            ->line("Date : ".$this->data->Date)
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
