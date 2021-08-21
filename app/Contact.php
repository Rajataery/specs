<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contactUs';
    protected $fillable = ["name","email","message"];


}
