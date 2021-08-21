<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseType extends Model
{
    protected $table = 'course_type';

    protected $fillable = [
      "name","slug","price_1_12","price_12_24","price_24_36"
    ];
}
