<?php

namespace App;
use App\Course;
use App\Venue;

use Illuminate\Database\Eloquent\Model;

class Date extends Model
{
   protected $table = "dates";
   protected $fillable = [
   		"course_id", "venue_id", "event_title", "event_code",
        "currency", "course_vendor","course_category",
        "location_code", "includes_weekends", "date", "end_date",
        "time", "end_time", "guru_id", "seat", "seat_booked",
   	 	"price", "price_paid", "requests", "approved","language","status","vatamount","vat","is_display_vat"
   ];
   
   public function course(){
  		return $this->hasOne(Course::class,'id','course_id');
   }

   public function venue(){
  		return $this->hasOne(Venue::class,'id','venue_id');
   }

}
