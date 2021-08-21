<?php

namespace App\Http\Controllers;
use Auth;
use App\Admin;
use App\Date;
use App\User;
use App\Inhouse;
use App\Attendance;
use Carbon\Carbon;
use DB;
use App\Notifications\DateNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Request;

class DateController extends Controller
{
    public function index(){
        try{
            $guru_bookings = Inhouse::where([
                'guru_id' => Auth::user()->id,
                'type'    =>  'guru'
            ])->where('date', '>=', Carbon::now()->format('Y-m-d'))
            ->get();

            //public booking
            $dates = DB::table('dates')
            ->where('guru_id', 'like', '%'.Auth::user()->id.'%')
            ->where('Date', '>=', Carbon::now()->format('Y-m-d'))
            ->get();

            $bookings_inhouse = DB::table('bookings')
            ->where('type', 'in_house')
            ->where('guru_id', 'like', '%'.Auth::user()->id.'%')
            ->where('date', '>=', Carbon::now()->format('Y-m-d'))
            ->get();

            $tab = 'upcoming';
            return View('admin.guru.upcoming',compact('dates', 'guru_bookings','bookings_inhouse','tab' ));
        }
        catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function assginToMe(){
        try{
            return back();
            $data = Date::where('guru_id',Null)->orwhere('approved',0)->get();

            return View('admin.guru.assignDates',compact('data'));
        }
        catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    
    public function view($id, $type)
    {
        try{
            if($type == "guru"){
                $data = Inhouse::where([
                    'type' =>  'guru',
                    'id'   =>  $id
                ])->firstOrFail();

                return view('admin.guru.view-guru-booking',['data'=>$data] );

            }elseif ($type == "in_house"){
                 $data = Inhouse::where([
                    'type' =>  'in_house',
                    'id'   =>  $id
                ])->firstOrFail();

                return view('admin.guru.view-in-house-booking',['data'=>$data] );

            }elseif ($type == "public") {
                
                $data  = Date::findOrFail($id);
                return view('admin.guru.view-public-booking',['data'=>$data] );

            }else{
                return back();
            }
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    //Past Bookings 
    public function pastBookings(){
        try{
            $guru_bookings = Inhouse::where([
                'guru_id' => Auth::user()->id,
                'type'    =>  'guru'
            ])->where('date', '<', Carbon::now()->format('Y-m-d'))
            ->get();

            $dates = DB::table('dates')
            ->where('guru_id', 'like', '%'.Auth::user()->id.'%')
            ->where('Date', '<', Carbon::now()->format('Y-m-d'))
            ->get();

            $bookings_inhouse = DB::table('bookings')
            ->where('type', 'in_house')
            ->where('guru_id', 'like', '%'.Auth::user()->id.'%')
            ->where('date', '<', Carbon::now()->format('Y-m-d'))
            ->get();

            $tab = 'past';

            return View('admin.guru.past',compact('dates', 'guru_bookings','bookings_inhouse','tab' ));
        }
        catch(Exception $e){
            return back();
        }
    }

    public function availableBookings(){
        try{
            $dates = DB::table('dates')
            ->where('guru_id',Null)
            ->where('Date', '>=', Carbon::now()->format('Y-m-d'))
            ->where('course_vendor','first_aid')
            ->get();

            $bookings_inhouse = Inhouse::where('guru_id',Null)
            ->where('type', 'in_house')
            ->where('date', '>', Carbon::now()->format('Y-m-d'))
            ->get();

            $tab = 'available';
            return View('admin.guru.available',compact('dates', 'bookings_inhouse', 'tab' ));
        }
        catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function pendingBookings(){
        try{
            $dates = DB::table('dates')
            ->where('requests', 'like', '%'.Auth::user()->id.'%')
            ->where('Date', '>=', Carbon::now()->format('Y-m-d'))
            ->get();

            $bookings_inhouse = DB::table('bookings')
            ->where('type', 'in_house')
            ->where('requests', 'like', '%'.Auth::user()->id.'%')
            ->where('date', '>=', Carbon::now()->format('Y-m-d'))
            ->get();

            $tab = 'pending';
            return View('admin.guru.pending',compact('dates','bookings_inhouse','tab' ));
        }
        catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    //Request booking
    public function assginMe($id, $type){
        try{
            $admin = Admin::where('id',1)->first();
            $data['user'] = User::findOrFail(Auth::user()->id);

            if($type == "public"){
                $data['date'] = Date::where('id',$id)->with('course')->firstOrFail();
                $sub = explode(',', $data['date']->requests);

                if(! in_array($data['user']->id, $sub)){
                    $sub1 = array(Auth::user()->id);
                    $sub2 = array_merge($sub,$sub1);
                    $entry['requests'] = implode(',',$sub2);
                    Date::where('id',$id)->update($entry);
                    Notification::send( $admin, new DateNotification($data));
                    return redirect()->route('gurubookings.pendingRequested')->with('success', "Request Sent");
                }else{
                    return redirect()->route('gurubookings.available')->with('success', "You have already requested to this booking");
                }
            }elseif($type == "in_house"){
                
                $data['date'] = Inhouse::where('id',$id)->with('course')->firstOrFail();
                $sub = explode(',', $data['date']->requests);
                $data['date']->Date = $data['date']->date;
                if(! in_array($data['user']->id, $sub)){
                    $sub1 = array(Auth::user()->id);
                    $sub2 = array_merge($sub,$sub1);
                    $entry['requests'] = implode(',',$sub2);
                    Inhouse::where('id',$id)->update($entry);
                    Notification::send( $admin, new DateNotification($data));
                    return redirect()->route('gurubookings.pendingRequested')->with('success', "Request Sent");
                }else{
                    return redirect()->route('gurubookings.available')->with('success', "You have already requested to this booking");
                }
            }
            return redirect()->route('gurubookings.available');
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function candidateDetails(request $request){

        
        $date_id = request()->segment(2);

        $dates = DB::table('dates')
        ->where('id', $date_id)
        ->where('Date', '>=', Carbon::now()->format('Y-m-d'))
        ->first();

        $days = DB::table('courses')
        ->where('id',$dates->course_id)
        ->first();

        $course_time = $days->course_time; 

        $booking = Inhouse::with('getAttendance')->where('date_id', $date_id)
                    ->get();
            // dd($booking);
        $attendance = Attendance::with('getBookingID')->get();  
        
        return view('admin.guru.candidateDetails',compact('booking','course_time','attendance'));

    }

    public function candidateDetailsInhouse(request $request){


        $booking_id = request()->segment(2);

        $booking = Inhouse::with('getAttendance')
            ->where('type', 'in_house')
            ->where('guru_id', 'like', '%'.Auth::user()->id.'%')
            ->where('date', '>=', Carbon::now()->format('Y-m-d'))
            ->where('id',$booking_id)
            ->first();
            // dd($booking);
        $days = DB::table('courses')
        ->where('id',$booking->course_id)
        ->first();
// dd($days);
        $course_time = $days->course_time; 

        return view('admin.guru.candidateDetailsInhouse',compact('booking','course_time'));

    }

    public function candidateDetailsGuru(request $request){


        $booking_id = request()->segment(2);
            
            $guru_bookings = Inhouse::with('getAttendance')
                ->where([
                'guru_id' => Auth::user()->id,
                'type'    =>  'guru'
            ])->where('date', '>=', Carbon::now()->format('Y-m-d'))
            ->where('id',$booking_id)
            ->first();
           
        $days = DB::table('courses')
        ->where('id',$guru_bookings->course_id)
        ->first();

        $course_time = $days->course_time; 

        return view('admin.guru.candidateDetailsGuru',compact('guru_bookings','course_time'));

    }

    public function attendance(request $request){
        
        try { 
          
            $id = $request->booking_id;
            $dates = DB::table('dates')
            ->where('id', $request->date_id)
            ->first();

            $days = DB::table('courses')
            ->where('id',$dates->course_id)
            ->first();
            
            $data['date_id']   = $request->date_id;

            $ckid = $request->get('attendence');  

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

    public function attendanceInhouse(request $request){
        
        try { 
          
            $inhouse = DB::table('bookings')
            ->where('id', $request->booking_id)
            ->first();

            $days = DB::table('courses')
            ->where('id',$inhouse->course_id)
            ->first();
                $data['guru_id'] = Auth::user()->id;
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
            dd($e);
            $response = [
                "message" => $e->getMessage(),
                "status" => "fail"
            ];
            return response()->json($response, 422);
        }
    }

    

}
