<?php $url =  config('app.url').'/mailAccept/'.$booking_id;
$url_reject =  config('app.url').'/mailReject/'.$booking_id; ?>
@component('mail::message')

New {{ucwords($course_vendor)}} booking

Hi,

We have new booking for {{ucwords($course_vendor)}}<br>

Course Name: {{ $course_name }}<br>

Course Code: {{$course_code}}<br>

Event Code: {{$event_code}}<br>

Booked Seats : {{$booked_seats}}<br>

Venue : {{$venue}}<br>

Date :  {{$Date }}<br>

User Name :  {{$username }}<br>

User Email :  {{$useremail }}<br>

User Phone :  {{$userphone }}<br>

@component('mail::button', ['url' => $url])
Accept
@endcomponent

@component('mail::button', ['url' => $url_reject])
Reject
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
