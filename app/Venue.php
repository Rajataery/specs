<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    protected $fillable = [
    	"location_name", "address", "lat", "longitude",
    	"images", "floorPlan", "form", "location_code",
    	"address2", "town", "county", "post_code", "country",
    	"vendor", "is_site_allow"
    ];

}
