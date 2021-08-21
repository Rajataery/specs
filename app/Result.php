<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $table = 'result';

    protected $fillable = [
      "booking_id", "date_id","result"
    ];

     

}
