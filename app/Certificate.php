<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $table = 'certificates';

    protected $fillable = [
      "booking_id", "date_id","certificate"
    ];

     public function course(){
      return $this->hasOne(Course::class,'id','course_id');
   }
}
