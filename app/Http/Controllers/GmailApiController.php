<?php

namespace App\Http\Controllers;

use App\Course;
use App\Venue;
use App\Date;
use App\GmailSetting;
use Carbon\carbon;
use File;
use Storage;
use LaravelGmail;
use Illuminate\Http\Request;
use GuzzleHttp;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Dacastro4\LaravelGmail\Services\Message\Attachment;

class GmailApiController extends Controller
{
	// Client Email, from where to user recieve email
	private $email;

	//User Email which have access to read the client email
	private $user_email;

	public function __construct()
	{
	    set_time_limit(800000);
	    $this->email = "donotreply@redcross.org.uk";
	    $this->user_email = "firstaidguru786@gmail.com";
	}

	public function createToken()
	{
	    return LaravelGmail::redirect();
	}

    //Gmail Api
    public function callback()
    {
    	$token = LaravelGmail::makeToken();
    	if ($token['email'] == $this->user_email) {
	    	GmailSetting::updateOrCreate(
		        [
		        	'email' => $token['email'],
	         	],
		        [
		        	"access_token"  => $token['access_token'],
		    		"refresh_token" => $token['refresh_token'],
		    		"token_type"    => $token['token_type']
	    		]
		    );
		    return redirect()->route('read-email');
    	}else{
    		die("You are not authorized to access this.");
    	}
    	
    }

    // Read Emails
    public function readEmail()
    {
    	$is_token_expire = LaravelGmail::isAccessTokenExpired();

    	if ($is_token_expire) {
    		$token = GmailSetting::where('email', $this->user_email)->first();

	    	//Create new access_token using refresh_token
	    	if($token){
	    		$new_token = LaravelGmail::fetchAccessTokenWithRefreshToken($token->refresh_token);

	    		$token->update([
	    			"access_token"  => $new_token['access_token'],
		    		"refresh_token" => $new_token['refresh_token'],
		    		"token_type"    => $new_token['token_type']
	    		]);
	    	}else{
	    		die("Token Expired, Please create a new token.");
	    	}
    	}

		$email = $this->email;
    	$emails = LaravelGmail::message()->from($email)->unread()->hasAttachment()->all();

		if($emails->count()){
	    	foreach ( $emails as $key => $mail ) {
	    		$mail = $mail->load();
			    $attachments =  $mail->getAttachments();

			    if($attachments->count()){

		    		foreach ($attachments as $key => $attachment) {
				    	$file_name = time()."_".str_replace(" ", "_", $attachment->getFileName());
				    	$attachment->saveAttachmentTo(null, $file_name, 'mail_files');

				    	if (Storage::disk('mail_files')->exists($file_name)) {
						    $stored_file = config("app.url").Storage::url('mail_files/'.$file_name);

						    $file = fopen($stored_file, "r");

						    $row = 0;
						    if (($file = fopen($stored_file, "r")) !== FALSE) {
						  		while (($data = fgetcsv($file, 10000, ",")) !== FALSE) {
						  			$row++;

								    if($row == 1){
								    	continue;
								    }else{

								    	if($data[0]){
									    	//Course data
									    	$data_course = [];
									    	$data_course['code']     = $data[0];
									    	$data_course['title']    = $data[1];
									    	$data_course['language'] = $data[2];
									    	$data_course['course_rrp'] 	= $data[3];
									    	$data_course['course_currency'] = $data[4];

									    	//event data
									    	$data_event = [];
									    	$data_event['course_vendor']   = $data[5];
									    	$data_event['course_category'] = $data[6];
									    	$data_event['code'] 	= $data[7];
									    	$data_event['title'] 	= $data[8];
									    	$data_event['language'] = $data[9];
									    	$data_event['rrp'] 		= $data[10];
									    	$data_event['currency'] = $data[11];
									    	$data_event['start'] 	= $data[12];
									    	$data_event['end'] 		= $data[13];
									    	$data_event['include_sweekends'] = $data[14];
									    	$data_event['spaces'] 	= $data[15];

									    	//venue location data
									    	$data_location = [];
									    	$data_location['location_code'] = $data[16];
									    	$data_location['name'] 		= $data[17];
									    	$data_location['address1'] 	= $data[18];
									    	$data_location['address2'] 	= $data[19];
									    	$data_location['town'] 		= $data[20];
									    	$data_location['county'] 	= $data[21];
									    	$data_location['country'] 	= $data[22];
									    	$data_location['postcode'] 	= $data[23];

									    	// Check if course exist
									    	$get_course = Course::where('code', $data_course['code'])->first();

									    	if( $get_course ){

									    		// Venue Location
								    			$venue = $this->venueLocation($get_course->id, $data_location);
								    			
								    			// Events date
								    			$event = $this->dateEvent($get_course->id, $venue->id, $data_event);

									    	}else{
									    		//Create Course
									    		$course = Course::create([
										        	'code' 		   => $data_course['code'],
										        	'course_name'  => $data_course['title'],
										        	'course_title' => $data_course['title'],
										        	'status'       => 0,
									    		]);
										    	
										    	// Venue Location
								    			$venue = $this->venueLocation($course->id, $data_location);
								    			
								    			// Events date
								    			$event = $this->dateEvent($course->id, $venue->id, $data_event);
									    	}
								    	}
								    }
							  	}
							  	fclose($file);
							}
						}
				    }
			    }

			    $mail->markAsRead();
			}
		}
		return "Successfull";
    }

    /**
     * Create update Venue Location
	 * @return venue
	 * 
	*/
    public function venueLocation($course_id, $location)
    {
    	$data =  [
			'location_code' => $location['location_code'],
        	'location_name' => $location['name'],
        	'address'	 => $location['address1'],
        	'address2' 	 => $location['address2'],
        	'town' 		 => $location['town'],
        	'county' 	 => $location['county'],
        	'post_code'  => $location['postcode'],
        	'country' 	 => $location['country'],
        	'vendor'     => "british_red_cross",
		];

        	// 'lat'		 => $get_data['lat'],
        	// 'longitude'	 => $get_data['long'],
        	// 'is_site_allow' => 0,

    	$venue = Venue::where('location_code', $location['location_code'])->first();
    	if($venue){
    		if($venue->address	== $location['address1']){
    			$venue->update($data);
    		}else{
    			$address = $location['address1'].",".$location['town']." ".$location['postcode'].",".$location['county']." ".$location['country'];
    			$get_data = $this->getCoordinates($address);

    			$data['lat'] 			= $get_data['lat'];
	    		$data['longitude'] 		= $get_data['long'];
	    		// $data['is_site_allow'] 	= 0;

    			$venue->update($data);
    		}
    	}else{
    		$address = $location['address1'].",".$location['town']." ".$location['postcode'].",".$location['county']." ".$location['country'];
			$get_data = $this->getCoordinates($address);

    		$data['lat'] 			= $get_data['lat'];
    		$data['longitude'] 		= $get_data['long'];
    		$data['is_site_allow'] 	= 0;

    		$venue = Venue::create( $data);
    	}
    	return $venue;
    }

    /**
     * Create update Event(dates)
	 * @return event
	 * 
	*/
    public function dateEvent($course_id, $venue_id, $event)
    {
    	$start_date = explode('  ', $event['start']);
    	$end_date   = explode('  ', $event['end']);

    	$data = [
        	'course_id'   => $course_id,
        	'venue_id'    => $venue_id,
        	'event_code'  => $event['code'],
        	'event_title' => $event['title'],
        	'price'       => $event['rrp'],
        	'date'        => Carbon::parse($start_date[0])->format('Y-m-d'),
        	'end_date'    => Carbon::parse($end_date[0])->format('Y-m-d'),
        	'time'        => $start_date[1],
        	'end_time'    => $end_date[1],
        	'seat' 	      => $event['spaces'],
        	'seat_booked' => 0,
        	'language'    => $event['language'],
        	'currency'   =>  $event['currency'],
        	'course_vendor'     => "british_red_cross",
        	'course_category'   => $event['course_category'],
        	'includes_weekends' => $event['include_sweekends'],
		];

    	$event_date = Date::where([
    		'course_id'  => $course_id,
        	'venue_id'   => $venue_id,
        	'event_code' => $event['code']
    	])->first();

    	
    	if($event_date){
    		$event_date->update($data);
    	}else{

    		if($event['spaces'] > 1){
				$event_date = Date::create($data);
    		}
    	}
    	return $event_date;
    }

    /**
	 * @return Coordinates
	 * 
	 */
    public function getCoordinates($address)
    {
   		$apiKey = "AIzaSyCGW-QD1FkFxATHWyBjcqrLxD8CcvzVip4";
        $address = str_replace(" ", "+", $address);
	 	$get_geocode = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$address.'&sensor=false&key='.$apiKey);
		$result = json_decode($get_geocode);

		// Get latitude and longitude from the geodata
		$data['lat'] = $result->results[0]->geometry->location->lat;
		$data['long'] = $result->results[0]->geometry->location->lng;
		return $data;
    }

}
