<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseUnit extends Model
{
    protected $table = 'course_units';

    protected $fillable = [
      "course_id","name"
    ];
}
