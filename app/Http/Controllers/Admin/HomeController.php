<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Inhouse;
use App\User;
use App\Customer;
use App\Course;
use App\Date;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin-web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.index');
    }
    
    public function inHouseBooking()
    {
        $data = Inhouse::with('course')->where([
            'type' => 'in_house',
            'payment_status' => 'succeeded'
        ])->latest()->paginate(10);

        $gurus = User::where('status', 1)->get(); 
        return view('admin.inhouse.index',['data'=>$data, 'gurus' => $gurus]);
    }
    
    public function inHouseBookingView($id)
    {
        $gurus = User::all(); 
        $data = Inhouse::where('id',$id)->with('course')->first();

        if($data->notification_status == 1){
            $data->notification_status = 0;
            $data->save();

        }
        $guru = $data->guru_id;
        $guru = explode(',',$guru);

        if(is_array($guru)){
            $data->guru = User::whereIn('id',$guru )->get();
        }else{
            $data->guru = [];
        }
        return view('admin.inhouse.view',['data'=>$data, 'gurus' => $gurus]);
    }
    
    public function assignGuru(request $req,$id)
    {
        $item['guru_id'] = implode(',',$req->guru_id);
        $data = Inhouse::where('id',$id)->update($item);
        return redirect()->back();
    }
    
    public function approveBooking($id)
    {
        $item['approved'] = 1;
        $data = Inhouse::where('id',$id)->update($item);
        return redirect()->back();
    }
    
    public function setPrice(request $req,$id)
    {
        $item['guruPrice'] = 1;
        $item['price'] = 1;
        
        $data = Inhouse::where('id',$id)->update($item);
        return redirect()->back();
    }

    //Public Booking
    public function publicBooking()
    {
        $data = Inhouse::with('getDate.venue','getDate.course')
        ->where(['type' => 'public',
            'payment_status' => 'succeeded'
        ])->latest()->paginate(10);

        return view('admin.public-booking.index',['data'=>$data]);
    }
    
    //customer
    public function customers(Request $request){
        $data = Customer::get();
        // dd($data);
        // $customer_id = array();
        // foreach ($customer as $id) {
        //     $customer_id[] = $id['id'];
        // }
        // $data = Inhouse::with('getDate.venue','getDate.course')
        //     ->whereIn('customer',$customer_id)
        //     ->get();
        //dd($data);
        return view('admin.customer.customer',['data'=>$data]);
    }


    public function customer_details(){
    
    $id = request()->segment(3);
    //dd($id);
    $data = Customer::where('id',$id)
    ->get();
   //dd($data);
    return view('admin.customer.customer-view',['data'=>$data]);

   }


    public function customer_bookings($id){
    
    $ids = request()->segment(3);
    //dd($id);
        $data = Inhouse::with('getDate.venue','getDate.course')
            ->where('customer',$ids)
            ->get();
 //dd($data);
//dd($public_course);
    
    return view('admin.customer.customer-booking',['data'=>$data]);

   }
    //Public Single Booking View
    public function publicBookingView($id)
    {
        $data = Inhouse::where(['id'=>$id,'type' => 'public'])->with('getDate.venue','getDate.course')->first();
        //dd($data);
        if($data->notification_status == 1){
                $data->notification_status = 0;
                $data->save();
            }

        $guru = $data->getDate->guru_id;
        $guru = explode(',',$guru);
        $gurus = User::all(); 
        if(is_array($guru)){
            $data->guru = User::whereIn('id',$guru )->get();
        }else{
            $data->guru = []; 
        }

        return view('admin.public-booking.view',['data'=>$data, 'gurus' => $gurus]);
    }

//------------------------- Update Public Booking ----------------------------//
  
  public function publicBookingUpdate($id , Request $request)
    {
        try{
            $id = request()->segment(3);

            $data['name'] = $request->cust_name;
            $data['email'] = $request->cust_email;
            $data['phone'] = $request->cust_phone;

            $update = Inhouse::find($id);
            $update->update($data);
 
              return redirect('admin/publicBooking/view/'.$id);
        }catch(Exception $e){
            return back();
        }
    }

   

    //Guru Bookings
    public function guruBooking()
    {
        $data = Inhouse::with('course')
        ->where(['type' => 'guru',
            'payment_status' => 'succeeded'
        ])->latest()->paginate(10);


        return view('admin.guru-booking.index',['data'=>$data]);
    }

    //Guru Booking Single view
    public function guruBookingView($id)
    {
        $data = Inhouse::with('course')
        ->where(['type' => 'guru',
            'id' => $id
        ])->first();
        //dd($data);
        if($data->notification_status == 1){
            $data->notification_status = 0;
            $data->save();

        }

        $guru = User::where('id', $data->guru_id)->first();
        return view('admin.guru-booking.view',['data'=>$data, 'guru' => $guru]);
    }
}
