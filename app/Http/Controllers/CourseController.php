<?php

namespace App\Http\Controllers;


use App\Date;
use App\Payment;
use App\Course;
use App\Customer;
use App\Inhouse;
use App\Venue;
use App\User;
use App\Coupon;
use App\Setting;
use App\CouponCourse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Notifications\PublicBooking;
use App\Notifications\PublicEmail;
use App\Notifications\Booking;
use App\Notifications\inhousebooking;
use App\Notifications\ApproveNotification;
use App\Notifications\AdminApproveNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\StripePaymentController;


class CourseController extends Controller
{
    //Get inhouse Course Price
     public function getCoursePrice(Request $request)
    {
        try{            
            if($request->seats && $request->course_id){
                $column = "price_".$request->seats;
               $course =  Course::where('id', $request->course_id)->firstOrFail();

                $data['price'] = $course[$column];
                $response = [
                    "message" => "Success",
                    "data"    => $data,
                    "status" => 1
                ];
                return response()->json($response, 200);
            }else{
                $response = [
                    "message" => "Please select course and ",
                    "status" => 0
                ];
                return response()->json($response, 422);
            }
        }catch(\Exception $e){
            $response = [
                "message" => $e->getMessage(),
                "status" => 0
            ];
            return response()->json($response, 422);
        } 
    }

    // Inhouse Booking Course Chackout
    public function bookInhouseCourse(Request $request)
    {       
    //dd($request->all());
     DB::beginTransaction();
        try{
            $validator = \Validator::make($request->all(),[
                'course' => 'required',
                'participants' => 'required',
                'lat' => 'required',
                'lang' => 'required',
                'address' => 'required',
                'date' => 'required',
                'name' => 'required',
                'businessName' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'card_name'    => 'required',
                'stripeToken'  => 'required',
                'terms_and_conditions' => 'required'
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)->with('inhouse_error', "Please fill all fields");
            }

            $column = "price_".$request->participants;            
            $course_price =  Course::where('id', $request->course)->firstOrFail();
            $price = $course_price[$column];

//dd($price);

        if ($request->check_coupon == 'yes') {
                
                
            $currentDate = date('Y-m-d');


            $discount_code = Coupon::where('coupon_code',$request->coupon)
            ->where('start_date','<=',$currentDate)
            ->where('end_date','>=',$currentDate)
            ->firstOrFail();

            $vendor = explode(",",$discount_code['coupon_for']);
            
            // $couponcourse = CouponCourse::with('course')
            //                 ->where('course_id',$request->courses_id)
            //                 ->where('coupon_id',$discount_code['id'])->firstOrFail();

                           // dd($couponcourse);
            // $event = Date::where('id',$request->date_id)->first();

            // $vendorname = array_search($event['course_vendor'], $vendor);
            $discount = $discount_code->amount;
           
            if($discount_code){
                if ($discount_code->discount_type == "amount"){

                    $discount = $discount_code->amount;
                }else{
                    $discount = $discount_code->amount;
                    $discount = (($price * $discount)/100);
                }
            }else{
                $discount = 0;
            }

            $discount_amount = round($price - $discount);
           // print_r($discount_amount); die("up");
        } else{
            $discount_amount = round($price);
           // print_r($discount_amount); die("down");
        } 

            $stripeToken = $request->stripeToken;
            $stripe_data =['email'=>$request->email,'name'=>$request->name,'stripeToken'=>$stripeToken,'price'=>$discount_amount];
            // dd($stripe_data);
            $stripe_payment = StripePaymentController::stripePost($stripe_data);
            $payment_status = $stripe_payment[1]['status'];

            $data['course_id']    = $request->course;
            $data['address']      = $request->address;
            $data['lat']          = $request->lat;
            $data['lang']         = $request->lang;
            $data['participants'] =  str_replace('_','-',$request->participants);
            $data['date']         = $request->date;
            $data['email']        = $request->email;
            $data['name']         = $request->name;
            $data['phone']        = $request->phone;
            $data['business_name']  = $request->businessName;
            $data['type']           = 'in_house';
            $data['payment_status'] = $payment_status;
            $data['price']          = $price;
            $data['notification_status']  =  1;
            $data['course_name']  = Course::where('id',$data['course_id'])->pluck('course_name')->first();

            if($request->terms_and_conditions == "on"){
                $data['terms_and_conditions'] = 1;
            }
            
             $password = $request->name;
            $pass = substr($password, 0, strrpos($password, ' '));
            
            $check_customer = Customer::where('email',$request->email)->first();
            if(empty($check_customer)){

                $complete_pass = $pass.time();
                $data_cust['name']         = $request->name;
                $data_cust['email']        = $request->email;
                $data_cust['password']     = Hash::make($complete_pass);
                    
                    $cust_booking = Customer::Create($data_cust);
                        $data['customer']              = $cust_booking->id;
                    }else{
                        $complete_pass = "";
                        $data['customer']              = $check_customer->id;
                    }
            //$data['customer']  = $cust_booking->id;
            //dd($data['customer']);
            $booking = Inhouse::create($data);

            $data_payment['charge_id']     = $stripe_payment[1]['id'];
            $data_payment['customer_id']   = $stripe_payment[0]['id'];
            $data_payment['card_id']       = $stripe_payment[2]['id'];
            $data_payment['status']        = $payment_status;
            $data_payment['booking_id']    = $booking->id;

            Payment::create($data_payment);
            DB::commit();
            //dd($data_payment['booking_id']);
        
            Notification::route('mail', $request->email)
            ->notify(new Booking($data,$complete_pass));          

              if($payment_status == "succeeded"){
                $data['date'] = Carbon::parse($data['date'])->format('j F, Y');
                $data['course_name']  = Course::where('id',$data['course_id'])->pluck('course_name')->first();

                return redirect('/thank-you')->with('data', $data);
            }else{
                return back()->with('inhouse_error', "Booking payment failed, Please try again.");
            }
        }catch(\Exception $e){
            dd($e);
            DB::rollBack();
            return redirect()->back()->with('inhouse_error', $e->getMessage());
        }
    }
    
    // Publick Booking Course Chackout
    public function publicCourseCheckout(Request $request ) 
    {
       // dd($request->all());
        DB::beginTransaction();
        try{
            $validator = \Validator::make($request->all(),[
                'participants' => 'required',
                'date_id'      => 'required',
                'card_name'    => 'required',
                'stripeToken'  => 'required',
                'participant_detail.*.name' => 'required',
                'participant_detail.*.email' => 'required',
                'participant_detail.*.phone' => 'required',
                'terms_and_conditions' => 'required'
            ]);
            
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)->with('public_error', "Please fill all fields");
            }
         
            $date = Date::where('venue_id',$request->date_id)
            ->where('course_id',$request->courses_id)
            ->where('Date',$request->date)
            ->firstOrFail();

            $total_seats  = $date->seat;
            $seat_booked  = $date->seat_booked;
            $seats_left   = $total_seats - $seat_booked;
            $vat = $date->vat;
            $setting = Setting::first();
// dd($setting->vatamount);
            $price = round( ($date->price * $request->participants), 2);
       
            if ($date->seat_booked >= $date->seat) {
                return back()->with('public_error','No Seat Available');

            }else if( $seats_left >= $request->participants ){


                if($request->participants == 0){
                    if($date->vat == 1){
                        // dd($date->price);
                $price = ($date->price)+($date->price*$setting->value/100);
             // print_r('up'); dd($price1);
                }else{
                    $price = round( ($date->price), 2);
                }
                }else{
                    if($date->vat == 1){
                    $price = round( ($date->price * $request->participants)+($date->price*$setting->value/100), 2);
                   // print_r('down');     dd($price);
                    }else{
                         $price = round( ($date->price * $request->participants), 2);
                    }
                }
              
                if ($request->check_coupon == "yes") {
                  
                    $currentDate = date('Y-m-d');
                //echo "<pre>"; print_r($price); die('up'); 
                    $discount_code = Coupon::where('coupon_code',$request->coupon)
                    ->where('start_date','<=',$currentDate)
                    ->where('end_date','>=',$currentDate)
                    ->firstOrFail();

                    $vendor = explode(",",$discount_code['coupon_for']);
                    
                    $couponcourse = CouponCourse::with('course')
                                    ->where('course_id',$request->courses_id)
                                    ->where('coupon_id',$discount_code['id'])->firstOrFail();

                                   // dd($couponcourse);
                    $event = Date::where('venue_id',$request->date_id)
                                ->where('course_id',$request->courses_id)
                                ->where('Date',$request->date)
                                ->first();

                    $vendorname = array_search($event['course_vendor'], $vendor);
                    $discount = $discount_code->amount;
                    if($discount_code){
                        if ($discount_code->discount_type == "amount"){

                            $discount = $discount_code->amount;
                        }else{
                            $discount = $discount_code->amount;
                            $discount = (($price* $discount)/100);
                        }
                    }else{
                        $discount = 0;
                    }
                    $discount_amount = round($price - $discount);
                 
                }else{

                    $discount_amount = round($price);
                    
                }
                                  
                $stripeToken = $request->stripeToken;
                $stripe_data =['email'=>$request->participant_detail[0]['email'],'name'=>$request->card_name,'stripeToken'=>$stripeToken,'price'=> $discount_amount ];
               // dd($stripe_data);
                $stripe_payment = StripePaymentController::stripePost($stripe_data);
                $payment_status = $stripe_payment[1]['status'];

                //Booking Data
                $data['date_id']         = $date->id;
                $data['type']            = 'public';
                $data['participants']    = 1;
                $data['payment_status']  = $payment_status;
                $data['seat_booked']     = $request->participants;
                $data['price']           = $date->price;
                $data['course_name']     = $date->course->course_name;
                
                //Payment Data
                $data_payment['charge_id']    = $stripe_payment[1]['id'];
                $data_payment['customer_id']  = $stripe_payment[0]['id'];
                $data_payment['card_id']      = $stripe_payment[2]['id'];
                $data_payment['status']       = $payment_status;
                $data['notification_status']  =  1;
                if ($request->check_coupon == "yes") {
                    $data['discount']             =  $discount_code->amount;
                }else{
                    $data['discount']             =  0;
                }
                
                for ($i=0; $i < $request->participants+1; $i++) { 
                    //Booking
                    //dd($request->participants);
                    $password = $request->participant_detail[0]['name'];
                    $pass = substr($password, 0, strrpos($password, ' '));
                    
                    //dd($complete);
                    $data['email']                 = $request->participant_detail[$i]['email'];
                    $data['name']                  = $request->participant_detail[$i]['name'];
                    $data['phone']                 = $request->participant_detail[$i]['phone'];

                    $check_customer = Customer::where('email',$request->participant_detail[0]['email'] )->first();
                    
                    if(empty($check_customer)){
                        $complete_pass = $pass.time();

                        $data_cust['email']                 = $request->participant_detail[0]['email'];
                        $data_cust['name']                  = $request->participant_detail[0]['name'];
                        
                        $data_cust['password']              = Hash::make($complete_pass);
                       
                            $cust_booking = Customer::Create($data_cust);
                            $data['customer']              = $cust_booking->id;
                    }else{
                        $data['customer']              = $check_customer->id;
                        $complete_pass = "";
                    }
                    $booking = Inhouse::create($data);
                    //Payment
                    //dd($booking);
                    $data['address'] = Venue::where('id', $date->venue_id)->pluck('address')->first();
                    $data['date'] = $date->Date;

                    $data_payment['booking_id']    = $booking->id;
                    Payment::create($data_payment);
                    Notification::route('mail', $request->participant_detail[$i]['email'])
                    ->notify(new Booking($data,$complete_pass));
                }
       
                if($payment_status == "succeeded"){
                    $date->seat_booked  = $date->seat_booked + $request->participants;
                    $date->update();
                    DB::commit();
                    if($date->course_vendor == "british_red_cross"){
                        /*Notification::route('mail', 'test@gmail.com')
                            ->notify(new PublicBooking($date,$request->participants,$booking->id)); */
                            Notification::route('mail', 'upgrademetraining@gmail.com')
                            ->notify(new PublicEmail($date,$request->participants,$booking->id));
                    }
                    $data['date']         = Carbon::parse($date->Date)->format('j F, Y') ." | ". $date->time;
                    $data['address']      = Venue::where('id', $date->venue_id)->pluck('address')->first();
                    $data['course_name']  = $date->course->course_name;
                    $data['participants'] = $request->participants;
                    return redirect('/thank-you')->with('data', $data);
                }else{
                    $date->update();
                    DB::commit();
                    return back()->with('public_error', "Booking payment failed, Please try again.");
                }
            }else{
                return back()->with('public_error', "Please select less seats.");
            }
        }catch(\Exception $e){
            dd($e);
            DB::rollBack();
            return back()->with('public_error', $e->getMessage());
        }
    }

    public function bookingGuruCheckout(Request $request)
    {
     //    dd($request->all());
        DB::beginTransaction();
        try{
            $validator = \Validator::make($request->all(),[
                'course_id' => 'required',
                'guru_id' => 'required',
                'participants' => 'required',
                'lat' => 'required',
                'lang' => 'required',
                'address' => 'required',
                'date' => 'required',
                'name' => 'required',
                'businessName' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'stripeToken'  => 'required',
                'terms_and_conditions' => 'required'
            ]);

            /*$data = 1;
             Notification::route('mail', $request->email)
            ->notify(new Booking($data));*/

            if ($validator->fails()) {
                return redirect()->route('guru.single', $request->guru_id)->withErrors($validator);
            }

            $guru_bookings =  DB::table('bookings')
            ->where('guru_id', 'like', '%'.$request->guru_id.'%')
            ->where('Date', $request->date)->get();

            $guru_dates =  DB::table('dates')
            ->where('guru_id', 'like', '%'.$request->guru_id.'%')
            ->where('date', $request->date )->get();

            if($guru_bookings->count() || $guru_dates->count()){
                return redirect()->route('guru.single', $request->guru_id)
                    ->with('error_message', "This guru is not available or already booked on your selected date");
            }

            $guru = User::findOrFail($request->guru_id);
            $course = Course::findOrFail($request->course_id);

            $price = round($guru->rate * $course->course_time, 2);

            if ($request->check_coupon == 'yes') {
                
                
            $currentDate = date('Y-m-d');


            $discount_code = Coupon::where('coupon_code',$request->coupon)
            ->where('start_date','<=',$currentDate)
            ->where('end_date','>=',$currentDate)
            ->firstOrFail();

            $vendor = explode(",",$discount_code['coupon_for']);
                        
            $discount = $discount_code->amount;
           
            if($discount_code){
                if ($discount_code->discount_type == "amount"){

                    $discount = $discount_code->amount;
                }else{
                    $discount = $discount_code->amount;
                    $discount = (($price * $discount)/100);
                }
            }else{
                $discount = 0;
            }

            $discount_amount = round($price - $discount);
           // print_r($discount_amount); die("up");
        } else{
            $discount_amount = round($price);
           // print_r($discount_amount); die("down");
        } 

            $stripeToken = $request->stripeToken;
            $stripe_data =['email'=>$request->email,'name'=>$request->name,'stripeToken'=>$stripeToken,'price'=>$discount_amount];
            
            $stripe_payment = StripePaymentController::stripePost($stripe_data);
            $payment_status = $stripe_payment[1]['status'];

            $data['course_id']            = $request->course_id;
            $data['address']              = $request->address;
            $data['lat']                  = $request->lat;
            $data['lang']                 = $request->lang;
            $data['participants']         =  str_replace('_','-',$request->participants);
            $data['date']                 = $request->date;
            $data['email']                = $request->email;
            $data['name']                 = $request->name;
            $data['phone']                = $request->phone;
            $data['business_name']        =  $request->businessName;
            $data['type']                 = 'guru';
            $data['guru_id']              =  $guru->id;
            $data['payment_status']       =  $payment_status;
            $data['price']                =  $price;
            $data['notification_status']  =  1;
            $data['course_name']  = $course->course_name;

            $check_customer = Customer::where('email',$request->email)->first();

            $password = $request->name;
            $pass = substr($password, 0, strrpos($password, ' '));
            
            
            if(empty($check_customer)){
                $complete_pass = $pass.time();

                $data_cust['name']         = $request->name;
                $data_cust['email']        = $request->email;
                $data_cust['password']     = Hash::make($complete_pass);

                
                $cust_booking = Customer::Create($data_cust);
                $data['customer']              = $cust_booking->id;
            }else{
                $complete_pass = "";
                $data['customer']              = $check_customer->id;
            }


            $booking = Inhouse::create($data);

            $data_payment['charge_id']     = $stripe_payment[1]['id'];
            $data_payment['customer_id']   = $stripe_payment[0]['id'];
            $data_payment['card_id']       = $stripe_payment[2]['id'];
            $data_payment['status']        = $payment_status;
            $data_payment['booking_id']    = $booking->id;

            Payment::create($data_payment);
            DB::commit();

            $user = Customer::where('email', '=', $request->email)->count();
               // dd($user);
           
            //Email
            Notification::route('mail', $request->email)
            ->notify(new Booking($data,$complete_pass));

            if($payment_status == "succeeded"){
                $data['date'] = Carbon::parse($data['date'])->format('j F, Y');
                $data['course_name']  = $course->course_name;

                return redirect('/thank-you')->with('data', $data);
            }else{
                return redirect()->route('guru.single', $request->guru_id)->with('error_message', "Booking payment failed, Please try again.");
            }
        }catch(\Exception $e){ 
            DB::rollBack();
            return redirect()->route('guru.single', $request->guru_id)->with('error_message', $e->getMessage());
        }
    }

    public function thankYou(){
        
        return view('frontend.thank-you');
    }

    Public function mailAccept(Request $request) {
        $id = request()->segment(2);
        //dd($id);
        $data = Inhouse::findOrFail($id);
        //dd($data->email);
        $data->approved = 1;
        $data->save();
          if($data->approved == 1) { 
           // dd($data);
            $status = "Accepted";
            Notification::route('mail', $data->email)
            ->notify(new ApproveNotification($data,$status));
        
            Notification::route('mail', 'admin@admin.com')
            ->notify(new AdminApproveNotification($data,$status));
            return view('approvestatus',$data)->with('data', $data);
          }

    }


    Public function mailReject(){
        $id = request()->segment(2);
        $data = Inhouse::findOrFail($id);
        $data->approved = 2;
        $data->save();
        if($data->approved == 2) { 
            $status = "Rejected";
            Notification::route('mail', $data->email)
            ->notify(new ApproveNotification($data,$status));
           
            //dd($data);
            Notification::route('mail', 'admin@admin.com')
            ->notify(new AdminApproveNotification($data,$status));
            return view('approvestatus',$data)->with('data', $data);
        }
    } 

        Public function mailAccept_admin(Request $request) {
        $id = request()->segment(2);
        //dd($id);
        $data = Inhouse::findOrFail($id);
        //dd($data->email);
        $data->approved = 1;
        $data->save();
          if($data->approved == 1) { 
           // dd($data);
            $status = "Accepted";
            Notification::route('mail', $data->email)
            ->notify(new ApproveNotification($data,$status));
        
            Notification::route('mail', 'admin@admin.com')
            ->notify(new AdminApproveNotification($data,$status));
           return redirect()->back()->with('success','Email Accepted');
          }

    }


    Public function mailReject_admin(){
        $id = request()->segment(2);
        $data = Inhouse::findOrFail($id);
        $data->approved = 2;
        $data->save();
        if($data->approved == 2) { 
            $status = "Rejected";
            Notification::route('mail', $data->email)
            ->notify(new ApproveNotification($data,$status));
           
            //dd($data);
            Notification::route('mail', 'admin@admin.com')
            ->notify(new AdminApproveNotification($data,$status));
           return redirect()->back()->with('success','Email Rejected');
        }
    }

    Public function sendemail(Request $request){
        $id = request()->segment(2);
        $email =  $request->input('email');
        // dd($email);
        $data = Inhouse::findOrFail($id);
        if($data->approved == 2) { 
            $status = "Rejected";
            Notification::route('mail', $email)
            ->notify(new ApproveNotification($data,$status));
           
            Notification::route('mail', 'admin@admin.com')
            ->notify(new AdminApproveNotification($data,$status));
            return redirect('admin/publicBooking/view/'.$id)->with('success','Email Rejected');
        }elseif($data->approved == 1) { 
            $status = "Accepted";
            Notification::route('mail', $email)
            ->notify(new ApproveNotification($data,$status));
        
            Notification::route('mail', 'admin@admin.com')
            ->notify(new AdminApproveNotification($data,$status));
            return redirect('admin/publicBooking/view/'.$id)->with('success','Email accepted');
        }
    }    
   
    public function discountCode(Request $request)
    {
        
            try {   
            $currentDate = date('Y-m-d');

            $discount_code = Coupon::where('coupon_code',$request->discount_code)
            ->where('start_date','<=',$currentDate)
            ->where('end_date','>=',$currentDate)
            ->firstOrFail();
            $vendor = explode(",",$discount_code['coupon_for']);
            $setting = Setting::first();
            $couponcourse = CouponCourse::where('course_id',$request->course_id)
                            ->where('coupon_id',$discount_code['id'])->firstOrFail();
            // dd($couponcourse);
            // dd(array_search("british_red_cross", $vendor) == $request->vendor);
            if($request->price > $discount_code['amount']) {               
                
                if($request->type == 'public'){
                    $event = Date::where('venue_id',$request->date_id)
                    ->where('course_id',$request->course_id)
                    ->where('Date',$request->date)
                    ->first();
                
                    $vendorname = array_search($event['course_vendor'], $vendor);

                }

                    if ($discount_code['coupon_code'] == $request->discount_code){
                        
                            if($request->type == 'public'){
                                if($couponcourse['course_id'] == $request->course_id){
                                    if (array_search("first_aid", $vendor) == $request->vendor && array_search("british_red_cross", $vendor) == $request->vendor){ 
                            
                            $response = [
                                "message" => "Discount code is valid",
                                "data"    => $discount_code,
                                "setting"    => $setting,
                                "event"    => $event,
                                "status" => 1
                            ];
                        
                            return response()->json($response, 200);

                            }elseif($vendor[0] == $request->vendor){ 
                                
                                 $response = [
                                "message" => "Discount code is valid",
                                "data"    => $discount_code,
                                "setting"    => $setting,
                                "event"    => $event,
                                "status" => 1
                            ];
                             
                            return response()->json($response, 200);
                        }elseif($vendorname != false){ 
                                
                                 $response = [
                                "message" => "Discount code is valid",
                                "data"    => $discount_code,
                                "setting"    => $setting,
                                "event"    => $event,
                                "status" => 1
                            ];
                             
                            return response()->json($response, 200);
                           }else{
                                
                                $response = [
                            "message" => "Discount code is not valid",
                            "status" => 2
                            ];
                            
                        return response()->json($response, 422);
                            }
                             }
                        }else{
                            $event = Date::where('venue_id',$request->date_id)
                                    ->where('course_id',$request->course_id)
                                    ->where('Date',$request->date)
                                    ->first();
                            if($couponcourse['course_id'] == $request->course_id){
                                $response = [
                                "message" => "Discount code is valid",
                                "data"    => $discount_code,
                                "setting" => $setting,
                                "event"   => $event,
                                "status"  => 1
                                ];
                                
                            return response()->json($response, 200);
                        }else{
                        
                        $response = [
                            "message" => "Discount code is not valid",
                            "status" => 2
                        ];

                        return response()->json($response, 422);

                        }
                        }

                }else{
                 
                        $response = [
                            "message" => "Discount code is not valid",
                            "status" => 2
                        ];

                        return response()->json($response, 422);
                    }
                
            }else{ 
                                $response = [
                        "message" => "Discount code is not valid",
                        "status" => 2
                    ];

                    return response()->json($response, 422);

            }
           

        }catch (\Exception $e){
            // dd($e);
            $response = [
                "message" => $e->getMessage(),
                "status" => 2
            ];
            return response()->json($response, 422);
        }
    }



}
