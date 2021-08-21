<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{
  protected $table = 'notes';

    protected $fillable = [
      "booking_id", "date_id","notes"
    ];

}
