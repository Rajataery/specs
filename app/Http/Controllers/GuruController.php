<?php

namespace App\Http\Controllers;

use App\User;
use App\Admin;
use Auth;
use Illuminate\Support\Str;
use File;
use Storage;
use App\Course;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Notifications\UserNotification;
use App\Notifications\AdminNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;

class GuruController extends Controller
{
    public function becomeAguru(Request $req)
    {
        DB::beginTransaction();
        try{
            $validator = \Validator::make($req->all(),[
                'name'    => 'required',
                'email'   => ['required','email', 'max:255', 'unique:users'],
                'phone'   => 'required',
                'address' => 'required',
                'lat'     => 'required',
                'longitude' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)->withInput($req->all());
            }
            $data = $req->all();
            //dd($data);
            $default = 12345678;
            $data['password'] =  Hash::make($default);
            $data['api_token'] = Str::random(80);
            $data['notification_status'] = 1;

            // $cfrs =[];
            // if ($req->hasFile('certificates')) {
            //     foreach($req->certificates as $item){
            //         $cover = $item;
            //         $extension = $cover->getClientOriginalExtension();
            //         $cfr = $cover->getClientOriginalName();
            //         Storage::disk('files')->put( $cover->getClientOriginalName(),  
            //         File::get($cover));
            //         array_push($cfrs,$cfr);
            //     }
            // }
            // $data['certificates'] = implode(',',$cfrs);


            if ($req->hasFile('certificates')) {
                $cfrs =[];
                foreach($req->certificates as $key=> $item){
                    $cover = $item;
                    $extension = $cover->getClientOriginalExtension();
                    $cfr = time(). '_'.$cover->getClientOriginalName();
                    Storage::disk('files')->put( $cfr, File::get($cover));
                    // array_push($cfrs,$cfr);
                    $cfrs[$key]['file'] = $cfr;
                    $cfrs[$key]['name'] = ucfirst($cover->getClientOriginalName());
                    $cfrs[$key]['file_type'] = "";
                }
                $data['certificates'] = serialize($cfrs);
            }
            $user =  User::create($data);
            $admin = Admin::where('id',1)->first();
            Notification::send( $admin, new AdminNotification($user));
            DB::commit();
            return Redirect()->route('thanks');
        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error_message', $e->getMessage());
        }
    }
    
    public function profile()
    {
        $course  = Course::all()
        ->where('status',1);
        $data = User::findOrFail(Auth::user()->id);
       
        return view('admin.userProfile',['data'=> $data, 'course' => $course ]);
    }
    
    public function profilePost(request $request)
    {
        DB::beginTransaction();
        try{

            $user = User::findOrFail(Auth::user()->id);
            $validator = \Validator::make($request->all(),[
                'name'     => 'required',
                'email'    => 'required',
                'title'    => 'required',
                'phone'    => 'required',
                'about'    => 'required',
                'bank'     => 'required',
                'utr'      => 'required',
                'ifsc'     => 'required',
                'lat'      => 'required',
                'expiry'   => 'required',
                'address'  => 'required',
                'longitude'     => 'required',
                'experience'    => 'required',
                'qualification' => 'required',
                'course'        => 'required',                
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)->withInput($request->all())
                    ->with('error', "Please fill the required fields.");
            }
            
            $data['email']   = $request->email;
            $data['api_token'] = Str::random(80);
            $data['title']   = $request->title;
            $data['phone']   = $request->phone;
            $data['about']   = $request->about;
            $data['bank']    = $request->bank;
            $data['utr']     = $request->utr;
            $data['ifsc']    = $request->ifsc;
            $data['address'] = $request->address;
            $data['lat']     = $request->lat;
            $data['experience'] = $request->experience;
            $data['longitude']  = $request->longitude;
            $data['qualification'] = $request->qualification;
            $data['expiry'] = $request->expiry;

            if ($request->hasFile('profile')) {
                $image = $request->file('profile');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/frontend/images');
                $img = Image::make($image->getRealPath());
                $img->resize(500, 500, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.'/'. $name);
                $data['profile'] = $name;
            }

            $cfrs =[];
            if ($user->certificates) {
                $certificates = unserialize($user->certificates);
                $cfrs = $certificates;
                
                // Remove certificate files
                if (isset($request->remove_certificates)) {
                    $files_remove = explode(",", $request->remove_certificates);

                    foreach ($files_remove as $key => $file) {
                        $get_file = $this->searchCertificateFile($certificates ,$file);
                        
                        if($get_file >= 0){
                            $remove_file = $certificates[$get_file];
                            unset($certificates[$get_file]);
                            $isFileExists = Storage::disk('files')->exists($remove_file['file']);

                            if( $isFileExists ){
                               Storage::disk('files')->delete($remove_file['file']);
                            }
                        }
                    }
                    $cfrs = $certificates;
                }
            }
        
            if ($request->certificates) {
                $certificate_data =[];
                foreach($request->certificates as $key=>$item){
                    $cover = $item['file']; 
                    $extension = $cover->getClientOriginalExtension();
                    $cfr = time(). '_'.$cover->getClientOriginalName();
                    Storage::disk('files')->put( $cfr, File::get($cover));
                    $certificate_data['file'] = $cfr;
                    $certificate_data['name'] = ucfirst($item['name']);
                    $certificate_data['file_type'] = $item['type'];
                    array_push($cfrs, $certificate_data);
                }
            }

            if( count($cfrs) ){
                $data['certificates'] = serialize($cfrs);
            }else{
                $data['certificates'] = null;
            }

            if($request->password){
                $data['password'] = Hash::make($request->password);
            }

            $data['course'] = implode(',',$request->course);
            $user->update($data);
            DB::commit();
            return redirect()->back()->with('success', "Profile updated successfully");

        }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    //Search Certificate
    public function searchCertificateFile($items, $file)
    {
       foreach ($items as $key => $item) {
           if ($item['file'] === $file) {
               return $key;
           }
       }
       return false;
    }

 
}
