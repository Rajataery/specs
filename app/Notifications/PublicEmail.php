<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Venue;
use App\Course;
use App\Inhouse;
class PublicEmail extends Notification
{
    use Queueable;
        Public $data;
        Public $seats;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data, $seats,$id)
    {
        $this->data  = $data;
        $this->seats = $seats;
        $this->id = $id;
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
        $data = $this->data; 
        //dd($data);
        $Venue = Venue::where('id',$this->data->venue_id)->get();
        $course = Course::where('id',$this->data->course_id)->get();
        $venue_location =  $Venue[0]['location_name'];
        $course_vendor = $this->data->course_vendor;
        $course_name = $this->data->event_title;
        $course_code = $course[0]['code'];
        $event_code = $this->data->event_code;
        $booked_seats = $this->seats;
        $venue = $venue_location;
        $Date = $this->data->Date;
        $id = $this->data->id;
        $booking_id =$this->id;  

        $userInfo = Inhouse::where('id',$booking_id)->get();
        $username = $userInfo[0]->name;
        $useremail = $userInfo[0]->email;
        $userphone = $userInfo[0]->phone;
 
        return (new MailMessage)
            ->markdown('mails.test', compact('course_vendor','course_name','course_code','event_code','booked_seats','venue','Date','id','booking_id','username','useremail','userphone'));
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
