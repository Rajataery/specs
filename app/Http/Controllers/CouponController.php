<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CouponController extends Controller
{
   
public function index{



return view('admin.coupon.coupon');


}

}
