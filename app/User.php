<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $fillable = [
        'name', 'email','profile', 'course','password', 'api_token','address','lat','longitude','certificates','qualification','about','title','experience','profile','phone','status','bank','ifsc','utr','seo_discription','seo_title','seo_keyword','notification_status','rate','expiry',
    ];

    
    protected $hidden = [
        'password', 'remember_token',
    ];

   
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
