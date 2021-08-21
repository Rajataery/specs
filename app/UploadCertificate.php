<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UploadCertificate extends Model
{
    protected $table = 'uploadcertificate';

    protected $fillable = [
      "booking_id", "date_id","certificate","result"
    ];

     public function course(){
      return $this->hasOne(Course::class,'id','course_id');
   }
}
