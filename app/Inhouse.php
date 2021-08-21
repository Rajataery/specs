<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inhouse extends Model
{
    protected $table = 'bookings';

    protected $fillable = [
      "course_id","type","guru_id","date",
      "address","lat","lang","name","email",
      "phone", "approved","participants","business_name",
      "price","guruPrice","date_id","payment_status", 'requests',
      'terms_and_conditions','notification_status',"customer","discount"
    ];

    public function course(){
      return $this->hasOne(Course::class,'id','course_id');
    }

    public function getDate(){
      return $this->hasOne(Date::class,'id','date_id');
    }
    public function getAttendance(){
      return $this->hasMany(Attendance::class,'booking_id','id');
    }
    public function getNotes(){
      return $this->hasOne(Notes::class,'booking_id','id');
    }
    public function getCertificate(){
      return $this->hasOne(UploadCertificate::class,'booking_id','id');
    }
    public function getResult(){
      return $this->hasOne(Result::class,'booking_id','id');
    }
}
