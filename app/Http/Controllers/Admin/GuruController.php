<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use DB;
use App\User;
use Exception;
use File;
use Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class GuruController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin-web');
    }
    
    public function index(){
        try{
            $data = User::latest()->get();
//dd($data);
            return view ('admin.Users.index',['data'=> $data]);
        }catch(Exception $e){ 
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function create(){
        try{
            $course = Course::where('status', 1)->get();
            return view ('admin.Users.create',['course'=>$course]);
        }catch(Exception $e){
           return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
            $inc_val =  $request->add_more_val;
            $validator = \Validator::make($request->all(),[
                'name'     => 'required',
                'email'    => ['required','email', 'max:255', 'unique:users'],
                'title'    => 'required',
                'phone'    => 'required',
                'about'    => 'required',
                'lat'      => 'required',
                // 'expiry'   => 'required',
                'address'  => 'required',
                'course'   => 'required',
                'rate'     => 'required',
                'status'   => 'required',
                'password' => 'required|min:5',
                'profile'  => 'required',
                'seo_title'     => 'required',
                'seo_keyword'   => 'required',
                'longitude'     => 'required',
                'experience'    => 'required',
                'qualification' => 'required',
                'seo_discription' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)->withInput($request->all())
                    ->with('error', "Please fill the required fields.");
            }

            $data['name']         =   $request->name;
            $data['seo_title']    =   $request->seo_title;
            $data['seo_keyword']  =   $request->seo_keyword;
            $data['email']        =   $request->email;
            $data['password']     =   Hash::make($request->password);
            $data['api_token']    =   Str::random(80);
            $data['title']        =   $request->title;
            $data['phone']        =   $request->phone;
            $data['about']        =   $request->about;
            $data['rate']         =   $request->rate;
            $data['address']      =   $request->address;
            $data['status']       =   $request->status;
            $data['lat']          =   $request->lat;
            $data['experience']   =   $request->experience;
            $data['longitude']    =   $request->longitude;
            $data['expiry']       =   $request->expiry;
            $data['qualification']   =   $request->qualification;
            $data['seo_discription'] =   $request->seo_discription;
            $data['course'] = implode(',',$request->course);

            if ($request->hasFile('profile')) {
                $image = $request->file('profile');
                $name = time() . '_' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/frontend/images');
                $img = Image::make($image->getRealPath());
                $img->resize(500, 500, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.'/'. $name);
                $data['profile'] = $name;
            }

            if ($request->certificates) {
                $cfrs =[];
                foreach($request->certificates as $key=> $item){
                    $cover = $item['file'];
                    $extension = $cover->getClientOriginalExtension();
                    $cfr = time(). '_'.$cover->getClientOriginalName();
                    Storage::disk('files')->put( $cfr, File::get($cover));
                    // array_push($cfrs,$cfr);
                    $cfrs[$key]['file'] = $cfr;
                    $cfrs[$key]['name'] = ucfirst($item['name']);
                    $cfrs[$key]['file_type'] = $item['type'];
                }

                $data['certificates'] = serialize($cfrs);
            }
            DB::commit();
            User::create($data);
            return redirect('admin/guruPanel')->with('success', "Guru created successfully");
        }catch(Exception $e){
            DB::rollBack();
            return back()->withInput($request->all())->with('error', $e->getMessage());
        }
    }

    public function edit(Request $request , $id){
        try{
            $data = User::findOrFail($id);
            $course = Course::where('status', 1)->get();
            return view('admin.Users.edit',['data'=>$data, 'course' => $course] );
        }catch(Exception $e){
           return redirect()->back()->with('error', $e->getMessage());
        }
    }
    
    public function guru_status($id){
        
        try {
            $User = User::findOrFail($id);
            //dd($User); 
            if($User->status == 0){
                $User->status = 1;
                $message = "Active Successfully";
            }else{
                $User->status = 0;
                $message = "Inactive Successfully";
            }
            $User->update();

            $response = [
                "message" => $message,
                "status" => "success"
            ];
            return response()->json($response, 200);

        } catch (Exception $e) {
            $response = [
                "message" => $e->getMessage(),
                "status" => "fail"
            ];
            return response()->json($response, 422);
        }
    }   
 
 

    public function update(Request $request , $id){
        try{
            $user = User::findOrFail($id);
            $validator = \Validator::make($request->all(),[
                
                'course'   => 'required',
                
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)->withInput($request->all())
                    ->with('error', "Please fill the required fields.");
            }

            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['seo_discription'] = $request->seo_discription;
            $data['seo_title'] = $request->seo_title;
            $data['seo_keyword'] = $request->seo_keyword;
            $data['api_token'] = Str::random(80);
            $data['title'] = $request->title;
            $data['qualification'] = $request->qualification;
            $data['phone'] = $request->phone;
            $data['about'] = $request->about;
            $data['rate'] = $request->rate;
            $data['address'] = $request->address;
            $data['lat'] = $request->lat;
            $data['status'] = $request->status;
            $data['experience'] = $request->experience;
            $data['longitude'] = $request->longitude;
            $data['expiry'] = $request->expiry;

            if ($request->hasFile('profile')) {
                $image = $request->file('profile');
                $name = time() . '_' . $image->getClientOriginalExtension();
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
            
            if (isset($request->certificates)) {
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

            $data['course'] = implode(',',$request->course);
            if($request->password){
                $data['password'] = Hash::make($request->password);
            }

            $user->update($data);
            DB::commit();
            return redirect('admin/guruPanel')->with('success', "Guru updated successfully");;
        }catch(Exception $e){
            DB::rollBack();
            dd($e);
           return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function view($id){
        try{
            $data = User::findOrFail($id);
//dd($data);
            if($data->notification_status == 1){
                $data->notification_status = 0;
                $data->save();
            }

            $courses = explode(',', $data->course);
            $courses = Course::whereIn('id', $courses)->get();
            return view('admin.Users.view',['data'=>$data, 'courses' => $courses] );
        }catch(Exception $e){
            return back()->with('error', $e->getMessage());
        }
    }

    public function delete($id){
        try{
            User::find($id)->delete();
            return redirect()->route('admin.guru')->with('success','Guru deleted successfully.');
        }catch(Exception $e){
            return back()->with('error', $e->getMessage());
        }
    }
      
    public function nearSearch(request $req)
    {
        // dd($req->all());
        $validator = \Validator::make($req->all(), [
                'address'   => 'required',
                'lat'       => 'required',
                'longitude' => 'required',
                'range'     => 'required'
            ]);
            if ($validator->fails()) {
                
                return redirect()->back()
                    ->withErrors($validator)->withInput($req->all())
                    ->with('error', "Please add a valid location.");
            }
        $latitude = $req->lat;
        $longitude = $req->longitude;
        $near = User::select("*", DB::raw("6371 * acos(cos(radians(" . $latitude . "))* cos(radians(lat)) * cos(radians(longitude) - radians(" . $longitude . "))+ sin(radians(" .$latitude. ")) * sin(radians(lat))) AS distance"))->get();
        $data = $near->where('distance', '<=', $req->range);

       return view('admin.Users.nearLocation',['data'=>$data, 'range' => $req->range, 'address' => $req->address]);
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
    //Search Certificate
   /* public function notification_status(request $req)
    {
        try{
       // dd($req['newStatus']);
         $data = User::findOrFail($req['newStatus']);
         $data->notification_status = 0;
         //dd($data);
         $user =  User::update($data);
       
       return false;
       }catch(Exception $e){
            return back()->with('error', $e->getMessage());
        }
    }*/
   


}
