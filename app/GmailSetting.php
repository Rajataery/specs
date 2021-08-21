<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GmailSetting extends Model
{
	protected $table = "gmail_setting";

   	protected $fillable = [
   		"access_token", "refresh_token",
   		"token_type", "email"
   ];
}
