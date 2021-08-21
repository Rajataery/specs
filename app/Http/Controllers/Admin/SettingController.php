<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Inhouse;
use App\User;
use App\Customer;
use App\Course;
use App\Date;
use App\Setting;
use Illuminate\Support\Facades\Auth;
use DB;
class SettingController extends Controller
{

public function index(){
	$setting = Setting::find(1);
	return view ('admin.settings.settings',['setting' => $setting]);
}


  
public function storeVatAmount(Request $request){
	try{
	    $setting = Setting::findOrFail(1);
	    $setting->value = $request->vatamount;
	    $setting->save();
	    DB::commit();
	    return  redirect()->route('admin.setting.vat')->with('success', "VAT created successfully");
	}catch( Exception $e){
	    DB::rollBack();
	    return redirect()->back()->with('error', $e->getMessage());
	}
}







}
