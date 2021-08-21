<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$check_profile_complete = $this->checkProfile();

    	if ($check_profile_complete == "yes") {
    		return redirect()->route("gurubookings.upcoming");
    	}else{
    		return redirect()->route("profile")->with("profile_message", "Please complete your profile.");
    	}
        //return view('admin.index');
    }

    //Check Guru Profile Completed or not
    public function checkProfile()
    {
        $guru = User::findOrFail(auth()->id());

        if (!$guru->name || !$guru->email || !$guru->title || !$guru->phone || !$guru->about  ||  !$guru->bank 
            || !$guru->utr  ||  !$guru->ifsc || !$guru->address || !$guru->lat  ||  !$guru->longitude || !$guru->experience 
            || !$guru->qualification || !$guru->expiry || !$guru->profile || !$guru->certificates)
        {
            $completed = "no";
        }else {
            $completed = "yes";
        }

        return $completed;
    }
}
