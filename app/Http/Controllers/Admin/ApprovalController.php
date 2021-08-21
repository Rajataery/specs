<?php

namespace App\Http\Controllers\Admin;

use App\Date;
use App\User;
use Exception;
use App\Inhouse;
use App\Course;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Venue;

class ApprovalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin-web');
    }
    
    public function index(){
        try{
            $data = Date::where('requests',"!=",Null)
            ->where('Date', '>=', Carbon::now()->format('Y-m-d'))
            ->with('course')->get();

            $inhouse_booking = Inhouse::where('requests',"!=",Null)
            ->where('Date', '>=', Carbon::now()->format('Y-m-d'))
            ->with('course')->get();

            return view ('admin.approval.index',['data'=> $data, 'inhouse_booking'=> $inhouse_booking]);
          }catch(Exception $e){
                return back();
        }
    }

    public function create(){
        try{
            $course = Course::all();
            $guru = User::all();
            $venue = Venue::all();
            return view ('admin.dates.create',['course'=>$course,'guru'=>$guru,'venue'=>$venue]);
            }catch(Exception $e){
                return back();
            }
    }
    public function store(Request $request){
        try{
                $data['date'] = $request->date;
                $data['time'] = $request->time;
                @$data['venue_id'] = $request->venue_id;
                @$data['course_id'] = $request->course_id;
                @$data['price'] = $request->price;
                @$data['seat'] = $request->seat;
                @$data['guru_id']   =$request->guru_id;
                Date::create($data);
                return redirect('admin/dates');
            }catch(Exception $e){
                return back();
            }

    }
    public function edit($id){
        try{
              $course = Course::all();
              $data = Date::findOrFail($id);
              $guru = User::all();
              $venue = Venue::all();
                return view('admin.dates.edit',['data'=>$data,'course'=>$course,'guru'=>$guru,'venue'=>$venue] );
            }catch(Exception $e){
                return back();
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
            @$data['guru_id']   =$request->guru_id;
            Date::where('id',$id)->update($data);
            return redirect('admin/dates');
        }catch(Exception $e){
            return back();
        }
    }

    public function view($id, $type){
        try{
            if($type == "public"){
                $data = Date::findOrFail($id);
                return view('admin.approval.view',['data'=>$data] );

            }elseif($type == "in_house"){
                $data = Inhouse::findOrFail($id);
                return view('admin.approval.view-inhouse',['data'=>$data] );
            }

            return redirect()->route('admin.requests');
            
        }catch(Exception $e){
            return back()->with('error', $e->getMessage());
        }
      }

    public function delete($id){
         Date::find($id)->delete();
        return redirect()->route('admin.dates');
      }

      // Confirm Request 
      public function confirm(Request $request, $id)
      {
        try{
            if ($request->type == "public") {
                $date = Date::findOrFail($id);

                $requests = explode(',', $date->requests);
                if(in_array($request->guru_id, $requests)){

                    if (($key = array_search($request->guru_id, $requests)) !== false) {
                        unset($requests[$key]);
                    }

                    $gurus = explode(',', $date->guru_id);
                    array_push($gurus, $request->guru_id);
                    array_filter($gurus);
                    $date->guru_id  = implode(',', $gurus);

                    array_filter($requests);
                    if (count($requests) > 0) {
                       $date->requests  = implode(',', $requests);
                    }else{
                       $date->requests  = Null;
                    }
                    $date->update();
                    return redirect()->route('admin.requests')->with('success', "Request confirmed.");

                }else{
                    return back();
                }
            }elseif ($request->type == "in_house") {
                $date = Inhouse::findOrFail($id);
                $requests = explode(',', $date->requests);

                if(in_array($request->guru_id, $requests)){

                    if (($key = array_search($request->guru_id, $requests)) !== false) {
                        unset($requests[$key]);
                    }

                    $gurus = explode(',', $date->guru_id);
                    array_push($gurus, $request->guru_id);
                    // array_filter($gurus);
                    $date->guru_id  = implode(',', $gurus);
                    if (count($requests) > 0) {
                       $date->requests  = implode(',', $requests);
                    }else{
                       $date->requests  = Null;
                    }
                    
                    $date->update();
                    return redirect()->route('admin.requests')->with('success', "Request confirmed.");

                }else{
                    return back();
                }
            }

            return back();

        }catch(Exception $e){
            return back()->with('error', $e->getMessage());
        }

      }
}

