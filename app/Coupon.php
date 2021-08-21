<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    
    protected $table = 'coupon';

    protected $fillable = [
    	'amount',
    	'coupon_code',
    	'discount_type',
    	'start_date',
    	'end_date',
    	'course',
    	'discount_type',
        'coupon_for',
    ];

    public function couponCourses(){
        return $this->hasMany(CouponCourse::class,'coupon_id','id');
    }
    
}
