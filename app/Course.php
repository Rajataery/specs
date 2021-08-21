<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
    	"course_name", "short_discription", "course_title",
    	"code", "course_file", "course_discription", "course_time",
    	"about_individuals_description", "about_organisations_description",
    	"phone","course_image", "price_1_12", "price_12_24", "price_24_36",
        "status","public_price","duration","description","other",
	];

    public function venue(){
        return $this->hasMany(venue::class,'course_id','id');
    }

    public function units(){
        return $this->hasMany(CourseUnit::class,'course_id','id');
    }
}
