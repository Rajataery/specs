<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
     protected $table = 'payment';

     protected $fillable = [
          "booking_id", "charge_id","customer_id",
          "card_id","status"
     ];

}
  