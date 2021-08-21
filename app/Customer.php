<?php

namespace App;



use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPasswordNotification;
use App\Notifications\VerifyEmailNotification;
use Illuminate\Database\Eloquent\Model;

class Customer extends Authenticatable implements MustVerifyEmail
{
    protected $table = 'customers';

    protected $fillable = [
    	'name',
    	'email',
    	'password'
    ];
    
   
   
    protected $hidden = [
        'password', 'remember_token',
    ];

    
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token, 'admin.password.reset', 'admins'));
    }

    
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailNotification('admin.verification.verify'));
    }

}