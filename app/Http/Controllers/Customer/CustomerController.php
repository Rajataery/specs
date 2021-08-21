<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Customer;
use App\Inhouse;
use App\Course;
use App\Date;
use PDF;
use Dompdf\Dompdf;
use Dompdf\Options;

class CustomerController extends Controller
{
   public function index(Request $request){


    $customer_id = Auth::guard('customer-web')->user();
//dd($customer_id->id);
    $data = Inhouse::with('getDate.venue','getDate.course')
            ->where('customer',$customer_id->id)
            ->latest()
            ->paginate(10);
    return view('customers.home',['data'=>$data]);

   }


   public function dashboard(Request $request){

   $customer= Auth::guard('customer-web')->user();
   $customername = $customer['name'];
    return view('customers.dashboard',['customername'=>$customername]);

   }
   
   public function customer_details(){
    
    $customer_id = request()->segment(3);

    $data = Inhouse::where('id', $customer_id)->get();

    $inhouse_course = Course::where('id',$data[0]['course_id'])->get();

    //dd($inhouse_course);

    $public_course = Date::where('id',$data[0]['date_id'])->get();
// dd($data);
//dd($public_course);
    
    return view('customers.customerdetails',['data'=>$data, 'courses' => $inhouse_course,'public_course' => $public_course]);


   }

   public function invoice(Request $request){


    $id = request()->segment(3);

    $data = Inhouse::with('getDate.venue','getDate.course')
            ->where('id',$id)
            ->get();
    //dd($data);
    $view = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('customers.invoice',['data'=>$data]);
    
   return $view->download('invoice.pdf');
   }


}
