<?php

namespace App\Providers;

use App\Date;
use App\User;
use App\Course;
use App\Venue;
use Illuminate\Support\ServiceProvider;

class VenueServiceProvider extends ServiceProvider
{
    /**
     * Event date guru
     *
     */
    public static function getGuru($ids)
    {
        $guru = explode(',',$ids);

        if(is_array($guru)){
            $guru = User::whereIn('id',$guru )->get();
        }else{
            $guru = collect();
        }
       return $guru;
    }

}
