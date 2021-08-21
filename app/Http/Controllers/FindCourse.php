<?php

namespace App\Http\Controllers;

use App\Course;
use App\Venue;
use App\Date;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use DateTime;
use Illuminate\Support\Facades\Session;

class FindCourse extends Controller
{
    public function Find(){
        $course_id = request()->course_id;
        $address = request()->address;
        $courses = Course::all();
        return view('frontend.booking-flow-corporate',compact('courses','address','course_id'));
    }

    //Public Booking
    public function bookingPublic( Request $request )
    {
        try{
            $courses = Course::all();
            if ($request->isMethod('post')) {
                $lat = $request->lat;
                $lang = $request->lang;
                $course_id = $request->course_id;
                $address = $request->address;

                if (isset($request->course_type)  && $request->course_type == "public" ) {
                    $validator = \Validator::make($request->all(),[
                        'course_id' => 'required',
                        'participants' => 'required',
                        'address' => 'required',
                        'lat' => 'required',
                        'lang' => 'required',
                    ]);

                    if($validator->fails()){
                        return back()->withErrors($validator);
                    }

                    $participants = $request->participants;
                    $course_type = 'public';
                    $course_name = $courses->where('id', $course_id)->pluck('course_name')->first();
                    return view('frontend.booking-flow-public',compact('courses','course_id','participants','address','lat','lang','course_type','course_name'));
                }else{
                    return view('frontend.booking-flow-public',compact('courses','address','course_id','lat','lang'));
                }
            }else{
                return view('frontend.booking-flow-public',compact('courses'));
            }
        }catch(\Exception $e){
            return view('frontend.booking-flow-public',compact('courses'));
        }
    }

    //Find Public Course
    public function findPublicCourse( Request $request)
    {
        try{
            $validator = \Validator::make($request->all(), [
                'course' => 'required',
                'address' => 'required',
                'lat' => 'required',
                'lang' => 'required'
            ]);
            if ($validator->fails()) {
                
                $response = [
                    "message" => "Please fill all fields.",
                    "status" => 0
                ];
                return response()->json($response, 422);
            }
            $number_val = $request->number_val;

            
            // $data_venue = [];
            $latitude  = $request->lat;
            $longitude = $request->lang;
            $distance  = 20;
            
            $result = DB::select("SELECT *,(((acos(sin((".$latitude."*pi()/180)) * sin((`lat`*pi()/180)) + cos((".$latitude."*pi()/180)) * cos((`lat`*pi()/180)) * cos(((".$longitude."- `longitude`)*pi()/180)))) * 180/pi()) * 60 * 1.1515)
            as distance FROM `venues` ORDER BY distance ASC");

            $result_data = collect($result);
            
            $venues = $result_data->where('distance', '<=', $distance)->take(3);
            
            // $course_data =  Course::where('id',$course_id)->firstOrFail();

            $response = [
                "message" => "Success",
                "data"    => $venues,
                // "course_data" => $course_data,
                "status" => 1
            ];
            return response()->json($response, 200);
            
            /* $current_date = Carbon::now()->format('Y-m-d');
            $get_venues_id = $venues->pluck('id')->toArray();

            $session = session(['venues_id' => $get_venues_id]);

            $getsession = Session::get('venues_id');
            
            $next_date = Date("Y-m-d", strtotime("$current_date +1 Month"));
            
                if($venues->count()){
                    if ($request->count == 1) {
                       
                        $get_venues_id = $venues->pluck('id')->toArray();
                  
                        $date_data = Date::where([
                            'course_id' => $request->course,
                        ])  ->where('Date', '>', Carbon::now()->format('Y-m-d'))
                            ->where('Date','<=', $next_date)
                            ->where('status',1)
                            ->whereIn('venue_id', $getsession)
                            ->orderBy('Date')
                            ->get();
                    }elseif($request->count > 1){
                            $next_date = Date("Y-m-d", strtotime("$current_date +".$request->count." Month"));
                           
                            $get_venues_id = $venues->pluck('id')->toArray();
                  
                            $date_data = Date::where([
                            'course_id' => $request->course,
                        ])  ->where('Date', '>', Carbon::now()->format('Y-m-d'))
                            ->where('Date','<=', $next_date)
                            ->where('status',1)
                            ->whereIn('venue_id', $get_venues_id)
                            ->orderBy('Date')
                            ->get();


                    }

            $course_id = $request->course;
            
            $course_data =  Course::where('id',$course_id)->firstOrFail();
                if($date_data->count()){
                    foreach($date_data as $key=>$data){
                        $venue = $venues->where('id', $data->venue_id)->first();

                        if($venue){
                            $data_venue[$key]['distance'] = round($venue->distance,2);
                            $data_venue[$key]['price'] = $data->price;
                            $data_venue[$key]['id'] = $data->id;
                            $data_venue[$key]['course_id'] = $data->course_id;
                            $data_venue[$key]['Date'] = $data->Date;
                            $data_venue[$key]['time'] = $data->time;
                            $data_venue[$key]['location_name'] = $venue->location_name;
                            $data_venue[$key]['address'] = $venue->address;
                            $data_venue[$key]['seat'] = $data->seat;
                            $data_venue[$key]['seat_booked'] = $data->seat_booked;
                            $data_venue[$key]['vendor'] = ucwords($data->course_vendor);
                        }
                    }

                    $response = [
                        "message" => "Success",
                        "data"    => $data_venue,
                        "course_data" => $course_data,
                        "status" => 1
                    ];
                    return response()->json($response, 200);
                }else{
                    $response = [
                        "message" => "No result found.",
                        "status" => 0
                    ];
                    return response()->json($response, 422);
                }
            }else{
                $response = [
                    "message" => "No result found.",
                    "status" => 0
                ];
                return response()->json($response, 422);
            }
            */
        }catch(\Exception $e){
            $response = [
                "message" => $e->getMessage(),
                "status" => 0
            ];
            return response()->json($response, 422);
        }
    }


    public function selectDate( Request $request)
    {
        // dd($request->all());
        try{
        $current_date = Carbon::now()->format('Y-m-d');
        $next_date = Date("Y-m-d", strtotime("$current_date +1 Month"));
        $dates = Date::where('venue_id',$request->venue_id)
        ->where('course_id',$request->course_id)
        ->get(); 
         
// dd($dates);
        // $dates = Date::where('venue_id',$request->venue_id)
        // ->where('course_id',$request->course_id)
        // ->where('Date', '>', Carbon::now()->format('Y-m-d'))
        // ->where('Date','<=', $next_date)
        // ->get(); 
             
  

            $response = [
                "message" => "Success",
                "data"    => $dates,
            
                "status" => 1
            ];
            return response()->json($response, 200);
                    
        }catch(\Exception $e){
            $response = [
                "message" => $e->getMessage(),
                "status" => 0
            ];
            return response()->json($response, 422);
        }
    }

    public function selectseats( Request $request)
    {
        // dd($request->all());
        try{
        $date = $request->date;
        $newDate = date("Y-m-d", strtotime($date));
        // dd($newDate);
        $seats = Date::where('venue_id',$request->venue_id)
        ->where('course_id',$request->course_id)
        ->where('Date',$newDate)
        ->first(); 
         // dd($seats);
        $response = [
            "message" => "Success",
            "data"    => $seats,
            "status"  => 1
        ];
        return response()->json($response, 200);
                    
        }catch(\Exception $e){
        $response = [
            "message" => $e->getMessage(),
            "status" => 0
        ];
            return response()->json($response, 422);
        }
    }



    


}
