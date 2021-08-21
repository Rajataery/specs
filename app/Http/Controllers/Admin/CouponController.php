<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Venue;
use App\Course;
use App\Coupon;
use App\CouponCourse;

class CouponController extends Controller
{
   
public function index(){

	$data = Coupon::all();
	return view('admin.coupon.index',['data'=>$data]);

}

public function insert(){

	$data = Course::all();
	return view('admin.coupon.coupon',['data'=>$data]);

}

public function store( Request $request){

 	try{

  		$data['coupon_code'] 		= $request->coupon_code;
        $data['discount_type'] 		= $request->discount_type;
        $data['amount'] 			= $request->amount;
        $data['start_date']			= $request->start_date;
        $data['end_date']			= $request->end_date;
        $data['coupon_for']         = implode(',',$request->coupon_for);
             
        $course = Coupon::create($data);
 
        $courses['coupon_id']         = $course->id;
        foreach($request->course_id as $role)
        {
       
           $courses['course_id']     =  $role;
           $coupon_course = CouponCourse::create($courses);
        }
             

        

    	return  redirect()->route('admin.coupon')->with('success', "Coupon created successfully");
	}catch( Exception $e){
		dd($e);
        DB::rollBack();
        return redirect()->back()->with('error', $e->getMessage());
    }


}

public function view( Request $request){

    $id = request()->segment(3);
    $data = Coupon::with('couponCourses.course')->where('id',$id)->firstOrFail();
    //dd($data);
    return view('admin.coupon.view',['data'=>$data]);

}




}
