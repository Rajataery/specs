<?php

namespace App\Http\Controllers\Admin;

use App\Date;
use App\User;
use Exception;
use App\Course;
use App\Attendance;
use App\Inhouse;
use App\Result;
use App\Setting;
use App\Certificate;
use App\UploadCertificate;
use App\Notes;
use Carbon\carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Venue;
use App\Providers\VenueServiceProvider;
use DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Exports\AttendanceExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Notifications\AttendenceNotification;
use Illuminate\Support\Facades\Notification;

class DateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin-web');
    }
    
    public function index(Request $request)
    {
        try{
            $course_vendor = "";
            $courses = Course::where('status', 1)->pluck('id')->toArray();
            $guru = User::get();
            $venue = Venue::get();
            $course = Course::get();
            $datas = Date::all();
            $data = Date::whereIn('course_id',$courses)
                ->where('Date', '>=', Carbon::now()->format('Y-m-d'))
                ->orderBy('Date', 'asc')->paginate(10);
              
            #filter []

           
            
            if (isset($request->course_vendor) && !empty($request->course_vendor)  && $request->course_vendor != '') {
                

                // $datas = Date::with('course','venue')
               $datas->where('course_vendor', 'LIKE','%'.$request->course_vendor.'%');
                // ->orderBy('Date', 'asc')->paginate(10);
            // echo "<pre>"; print_r($datas); die('datta');
                // $datas->withPath(url('/admin/dates?course_vendor='.$request->course_vendor));
                $course_vendor = $request->course_vendor;

            } 
            if (isset($request->datefilter) && !empty($request->datefilter) ) {
                

                $datas->where('Date', $request->datefilter);
                // ->orderBy('Date', 'asc')->paginate(10);
            echo "<pre>"; print_r($datas); die('datta');
                // $data->withPath(url('/admin/dates?course_vendor='.$request->course_vendor));
                $course_vendor = $request->course_vendor;

            } 
            if (isset($request->gurufilter)   && !empty($request->gurufilter)) {
                

                 $datas->where(function ($query) {
                                $query->whereRaw("find_in_set($request->gurufilter , guru_id)");});
                // ->orderBy('Date', 'asc')->paginate(10);
            // echo "<pre>"; print_r($datas); die('datta');
                // $data->withPath(url('/admin/dates?course_vendor='.$request->course_vendor));
                $course_vendor = $request->course_vendor;

            } 
            if (isset($request->locationfilter)   && !empty($request->locationfilter)) {
                

                 $datas->where('venue_id', $request->locationfilter);
                // ->orderBy('Date', 'asc')->paginate(10);
            // echo "<pre>"; print_r($datas); die('datta');
                // $data->withPath(url('/admin/dates?course_vendor='.$request->course_vendor));
                $course_vendor = $request->course_vendor;

            } 
            if (isset($request->coursefilter)   && !empty($request->coursefilter)) {
                

                 $datas->where('course_id', $request->coursefilter);
                // ->orderBy('Date', 'asc')->paginate(10);
            // echo "<pre>"; print_r($datas); die('datta');
                // $data->withPath(url('/admin/dates?course_vendor='.$request->course_vendor));
                $course_vendor = $request->course_vendor;

            } 
            

            return view ('admin.dates.index',['data'=> $data, 'type'=> 'upcoming', 'vendor' => $course_vendor,'guru' => $guru,'venue' => $venue,'course' => $course ]);
        }catch(Exception $e){
            dd($e);
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    //Past Dates/Eents
    public function pastDates(Request $request)
    {
        $course_vendor = "";
        $courses = Course::where('status', 1)->pluck('id')->toArray();
        $guru = User::get();
        $venue = Venue::get();
        $course = Course::get();
        if (isset($request->course_vendor)) {
            $data = Date::with('course','venue')
            ->whereIn('course_id',$courses)
            ->where('Date', '<', Carbon::now()->format('Y-m-d'))
            ->where('course_vendor', $request->course_vendor)
            ->orderBy('Date', 'desc')->paginate(10);

            $data->withPath('/admin/past-dates?course_vendor='.$request->course_vendor);
            $course_vendor = $request->course_vendor;

        }else{
            $data = Date::with('course','venue')
            ->whereIn('course_id',$courses)
            ->where('Date', '<', Carbon::now()->format('Y-m-d'))
            ->orderBy('Date', 'desc')->paginate(10);
        }

        return view ('admin.dates.index',['data'=> $data,'type'=> 'past', 'vendor' => $course_vendor, 'guru' => $guru , 'venue' => $venue, 'course' => $course ]);
    }


    public function create(){
        try{
            $course = Course::where('status',1)->get();
            $guru   = User::where('status', 1)->get();
            $venue  = Venue::where('is_site_allow',1)->get();
            return view ('admin.dates.create',['course'=>$course,'guru'=>$guru,'venue'=>$venue]);
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function store(Request $request){
        try{
            $data['date'] = $request->date;
            $data['time'] = $request->time;
            $data['venue_id'] = $request->venue_id;
            $data['course_id'] = $request->course_id;
            $data['price'] = $request->price;
            $data['seat'] = $request->seat;
            $data['guru_id']   = implode(',',$request->guru_id);
            $data['price_paid']   =$request->price_paid;

            Date::create($data);
            return redirect('admin/dates')->with('success', "Event created successfully");
        }catch(Exception $e){
           return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id){
        try{
                $data = Date::findOrFail($id);
                $course = Course::where('status', 1)->get();
                $setting = Setting::findOrFail(1);

                if($data->course_vendor == "first_aid"){
                    
                    $venue  = Venue::where('is_site_allow',1)->get();
                }else{
                    $venue  = Venue::where('vendor', 'british_red_cross')->get();
                }

                $guru = User::all();

                return view('admin.dates.edit',['data'=>$data,'course'=>$course,'guru'=>$guru,'venue'=>$venue, 'setting' => $setting] );
            }catch(Exception $e){
                return redirect()->back()->with('error', $e->getMessage());
            }
    }
    public function update(Request $request , $id){
        try{
            $data['date'] = $request->date;
            $data['time'] = $request->time;
            @$data['venue_id'] = $request->venue_id;
            @$data['course_id'] = $request->course_id;
            @$data['price'] = $request->price;
            @$data['seat'] = $request->seat;
            @$data['guru_id']   = implode(',',$request->guru_id);
            @$data['price_paid']   =$request->price_paid;
            @$data['is_display_vat']   =$request->is_display_vat;
            @$data['vatamount']   = $request->vat == "on" ? $request->vatamount : null;
            @$data['vat']   = $request->vat == "on" ? 1 : 0;
            Date::where('id',$id)->update($data);
            return redirect('admin/dates')->with('success', "Event updated successfully");
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function view($id){
        try {
            $data = Date::findOrFail($id);
            return view('admin.dates.view',['data'=>$data] );
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
      }

    public function delete($id){
        Date::find($id)->delete();
        return redirect()->route('admin.dates')->with('success', "Event Deleted successfully");
    }
    
    public function status($id){
        
        try {
            $dates = Date::findOrFail($id);
            //dd($dates); 
            if($dates->status == 0){
                $dates->status = 1;
                $message = "Event Status is Active";
            }else{
                $dates->status = 0;
                $message = "Event Status is InActive";
            }
            $dates->update();

            $response = [
                "message" => $message,
                "status" => "success"
            ];
            return response()->json($response, 200);

        } catch (Exception $e) {
            $response = [
                "message" => $e->getMessage(),
                "status" => "fail"
            ];
            return response()->json($response, 422);
        }
    }

    public function course_status($id){
        
        try {
            $dates = Course::findOrFail($id);
            //dd($dates); 
            if($dates->status == 0){
                $dates->status = 1;
                $message = "Course Added Successfully";
            }else{
                $dates->status = 0;
                $message = "Course Removed Successfully";
            }
            $dates->update();

            $response = [
                "message" => $message,
                "status" => "success"
            ];
            return response()->json($response, 200);

        } catch (Exception $e) {
            $response = [
                "message" => $e->getMessage(),
                "status" => "fail"
            ];
            return response()->json($response, 422);
        }
    }

    public function course_feature($id){
        
        try {
            $dates = Course::findOrFail($id);
            //dd($dates); 
            if($dates->featured == 0){
                $dates->featured = 1;
                $message = "Course featured Successfully";
            }else{
                $dates->featured = 0;
                $message = "Course Removed Successfully";
            }
            $dates->update();

            $response = [
                "message" => $message,
                "status" => "success"
            ];
            return response()->json($response, 200);

        } catch (Exception $e) {
            $response = [
                "message" => $e->getMessage(),
                "status" => "fail"
            ];
            return response()->json($response, 422);
        }
    }

    public function candidateDetailsPublic($id){

        $date_id = request()->segment(3);

        $dates = DB::table('dates')
        ->where('id', $id)
        ->first();

        $days = DB::table('courses')
        ->where('id',$dates->course_id)
        ->first();

        $course_time = $days->course_time; 

        $booking = Inhouse::with('getAttendance')
        ->where('date_id', $id)
        ->get();


        $result = Result::get();
        $uploadcertificate = UploadCertificate::get();
        $certificate = Certificate::where('course_id',$dates->course_id)->get();

        return view('admin.dates.candidateDetailsPublic',compact('booking','course_time','certificate','result','uploadcertificate'));

    }

     public function attendance(request $request){
        try { 
            $dates = DB::table('dates')
            ->where('id', $request->date_id)
            ->first();
            $days = DB::table('courses')
            ->where('id',$dates->course_id)
            ->first(); 
// dd($request->all());
            $data['date_id']   = $request->date_id;
            $certificate['date_id']   = $request->date_id;
            if ($request->hasFile('certificate')) {
                foreach ($request->file('certificate') as $key => $file) {

                    $image = $request->file('certificate');
                    $name = time() . '_' . $file->getClientOriginalExtension();
                    $destinationPath = public_path('/backend/images/certificate');
                    $file->move($destinationPath,$name);
                    $certificate['certificate'] = $name;
                    $certificate['booking_id'] = $key;
                    $uploadCertificate = UploadCertificate::where('booking_id',$key);

                    if($uploadCertificate->count() > 0 ){
                        UploadCertificate::where('booking_id',$key)->update($certificate);
                    }else{
                        UploadCertificate::create($certificate);
                    }
                }
            }
            foreach($request->pass as $key => $res){
                $result['booking_id'] = $key;
                $result['result'] = $res;
                $result['date_id'] = $request->date_id;
                $getResult = Result::where('booking_id',$key)->count();
                if($res != null){
                    if($getResult > 0 ){
                        Result::where('booking_id',$key)->update($result);
                    }else{
                        Result::create($result);
                    }
                }
            }
            foreach($request->attendence as $key => $value){
                $data['booking_id'] = $key;
                foreach ($value as $keys => $days) {
                    $data['day'] = $keys;
                    $data['attandance'] = $days;
                    $getAttendance = Attendance::where('booking_id',$key)
                    				->where('day',$keys)
                					->count();
                	if($getAttendance > 0 ){
                    	$attendance =  Attendance::where('booking_id',$key)
                    	->where('day',$keys)
                    	->update($data);
                    }else{
                    	$attendance =  Attendance::create($data);
                    }
                
                }
            }
            return Redirect()->back();
        } catch (Exception $e) {
         
            $response = [
                "message" => $e->getMessage(),
                "status" => "fail"
            ];
            return response()->json($response, 422);
        }
    }
    
    public function vatprice($id){
            try{
                $data = Date::findOrFail($id);
                $course = Course::where('status', 1)->get();

                $setting = Setting::findOrFail(1);

                $response = [
                    "date" => $data,
                    "setting" => $setting,
                    "status" => "success"
                ];
                return response()->json($response, 200);
            }catch(Exception $e){
                return redirect()->back()->with('error', $e->getMessage());
            }
        }

    public function sendMail(Request $request){
    
        try{
            $emailId = $request->all();
            $allemail = explode(",",$emailId['emailId']);
            $certificates = UploadCertificate::select('certificate')
                ->whereIn('booking_id',$allemail)
                ->get();
               
            $query = Inhouse::whereIn('id',$allemail)->get();
            foreach ($query as $value) {
               foreach ($certificates as $certificate) {
                $document = $certificate['certificate'];
                    Notification::route('mail', $value->email)
                    ->notify(new AttendenceNotification($document));
                }
            }
            return redirect()->back();
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }

    }

    public function notes(Request $request){
       try{
// dd($request->all());
            $data['booking_id'] = $request->bookingid;
            $data['date_id'] = $request->date_id;
            $data['notes'] = $request->notes;

            $getnotes = Notes::where('booking_id',$request->bookingid)
                                    ->count();
                if($getnotes > 0 ){
                    $attendance =  Notes::where('booking_id',$request->bookingid)
                        ->update($data);
                }else{
                    $attendance =  Notes::create($data);
                }

            return redirect()->back();
        }catch(Exception $e){
            dd($e);
            return redirect()->back()->with('error', $e->getMessage());
        }

    }
    
    public function exportReport($date_id)
    {
        try {
            return Excel::download(new AttendanceExport($date_id),'attendance.xlsx');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()
                ->with('error_message', 'Something went wrong, please refresh the page and try again.')
                ->with('tab','reports');
        }
    }
    

    public function searchfilter(Request $request){
        

        $date = Date::where('event_title','LIKE',"%$request->search%")
        ->where('course_vendor','LIKE',"%$request->search%")
        ->where('guru_id','LIKE',"%$request->search%")
        ->where('Date','LIKE',"%$request->search%")
        ->get();
        return $date;

    }


}

