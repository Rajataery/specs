<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendence';

    protected $fillable = [
      "date_id","booking_id","attandance", "day", "guru_id","certificate"
    ];


    public function getBookingID(){
      return $this->hasOne(Inhouse::class,'id','booking_id');
    }
}
