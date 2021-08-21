<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CouponCourse extends Model
{
   protected $table = 'coupon_courses';

    protected $fillable = [
    	'coupon_id',
    	'course_id',
    ];


public function course(){
        return $this->hasOne(Course::class,'id','course_id');
    }
    
}
