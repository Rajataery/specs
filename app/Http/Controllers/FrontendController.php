<?php

namespace App\Http\Controllers;

use App\Course;
use App\User;
use App\Contact;
use App\Inhouse;
use App\Date;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $data = Course::where('featured', 1)->get();
        $data_dropdown = Course::where('status', 1)->get();
        return view('frontend.index',['data'=>$data,'data_dropdown'=>$data_dropdown]);
    }
    public function course_detail($id)
    {
        $data = Course::Where('id',$id)->firstOrFail();
        return view('frontend.course-page',['data'=>$data]);
    }
    public function course_all()
    {
        $data = Course::where('status', 1)->get();
        return view('frontend.viewcourses',['data'=>$data]);
    }
    public function becomeAGuru()
    {
        return view('frontend.become-a-guru');
    }

    // In house Booking
    public function bookingFlowCorporate(Request $request)
    {
        try{
            $courses = Course::all();
            if ($request->isMethod('post')) {
                
                $course_id = $request->course_id;
                $participants = $request->participants;

                if (isset($request->course_type)  && $request->course_type == "private" ) {
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
                    $course_type = 'private';
                    $address = $request->address;
                    $lat = $request->lat;
                    $lang = $request->lang;
                    $course_name = $courses->where('id', $course_id)->pluck('course_name')->first();
                    return view('frontend.booking-flow-corporate',compact('courses','course_id','participants','address','lat','lang','course_type','course_name'));
                }
                return view('frontend.booking-flow-corporate',compact('courses','course_id','participants'));
                
            }else{
                return view('frontend.booking-flow-corporate',compact('courses'));
            }
        }catch(\Exception $e){
            return view('frontend.booking-flow-corporate',compact('courses'));
        }
    }

    public function bookingFlowGuru(Request $request)
    {
        try{
            $validator = \Validator::make($request->all(),[
                'course_id' => 'required',
                'participants' => 'required',
                'guru_id' => 'required',
                'address' => 'required',
                'lat' => 'required',
                'lang' => 'required',
            ]);

            if($validator->fails()){
                
                $response = [
                    "message" => "Please fill all fields.",
                    "status" => 0
                ];
                return response()->json($response, 422);
            }

            $address = [
                'address' => $request->address,
                'lat' => $request->lat,
                'lang' => $request->lang
            ];

            $guru = User::findOrFail($request->guru_id);

            if(!$guru->rate){
                $response = [
                    "message" => "Unable to book this guru, please try another guru.",
                    "status" => 0
                ];
                return response()->json($response, 422);

            }else{
                $course = Course::findOrFail($request->course_id);
                $data['price'] = round( ($guru->rate * $course->course_time), 2);

                $guru_bookings =  DB::table('bookings')
                ->where('guru_id', 'like', '%'.$guru->id.'%')
                ->where('date', '>', Carbon::now()->format('Y-m-d'))
                ->pluck('date');

                $guru_dates =  DB::table('dates')
                ->where('guru_id', 'like', '%'.$guru->id.'%')
                ->where('Date', '>', Carbon::now()->format('Y-m-d'))
                ->pluck('Date');
                
                $bookings =  $guru_bookings->concat($guru_dates)->toArray();
                $data['bookings'] = implode(",",$bookings);

                $data['participants'] = $request->participants;
                $data['course'] = $course;

                $response = [
                    "message" => "Success",
                    "data"    => $data,
                    "status" => 1
                ];

                return response()->json($response, 200);
            }
        }catch(\Exception $e){
            $response = [
                "message" => $e->getMessage(),
                "status" => 0
            ];
            return response()->json($response, 422);
        }
    }
    public function guruPage()
    {
        return view('frontend.guru-page');
    }
    public function thankYou()
    {
        return view('frontend.thank-you');
    }
    
    public function allGuru()
    {
        $data = User::where('status',1)->get();
    
        return view('frontend.allGuru',['data'=>$data]);
    }
    
    public function guru($id)
    {
        $data = User::where('id',$id)->first();
        $guru_courses = $data->course;
        $guru_courses = explode(',', $guru_courses); 
        $courses = Course::whereIn('id', $guru_courses)->get();
        return view('frontend.guru',['data'=>$data, 'courses' => $courses]);
    }
    
    public function contact(request $request){
      
        $data = $request->all();
        Contact::create($data);
        return redirect()->route('thanks');
    }

    public function thanks(){
      
        return view('frontend.thanks');
    }

    public function termConditions(){
        return view('frontend.terms-conditions');
    }

    public function aboutUs(){
        return view('frontend.about-us');
    }
}
