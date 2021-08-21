<?php

namespace App\Http\Controllers\admin;

use App\Venue;
use Exception;
use Storage;
use File;
use App\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VenueController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth:admin-web');
    }
    
    public function index(){
        try{
           $data = Venue::latest()->get();
           
            return view ('admin.venues.index',['data'=> $data]);
            }catch(Exception $e){
                return redirect()->back()->with('error', $e->getMessage());
            }
    }
    public function create(){
        try{
            return view ('admin.venues.create');
            }catch(Exception $e){
                return redirect()->back()->with('error', $e->getMessage());
            }
    }
    public function store(Request $request){
       
        try{
            $data['location_name'] = $request->location_name;
            $data['address'] = $request->address;
            $data['lat'] = $request->lat;
            $data['longitude'] = $request->longitude;
           $cfrs2 =[];
        if ($request->hasFile('form')) {
            foreach($request->form as $item){
                $cover = $item;
                $extension = $cover->getClientOriginalExtension();
                $cfr = rand(1111,9999) . '.' .  $cover->getClientOriginalName();
                Storage::disk('files')->put( $cfr,  
                File::get($cover));
                array_push($cfrs2,$cfr);
            }
        }
        $data['form'] = implode(',',$cfrs2);
         $cfrs =[];
        if ($request->hasFile('floorPlan')) {
            foreach($request->floorPlan as $item){
                $cover = $item;
                $extension = $cover->getClientOriginalExtension();
                $cfr =rand(1111,9999) . '.' .  $cover->getClientOriginalName();
                Storage::disk('files')->put( $cfr,  
                File::get($cover));
                array_push($cfrs,$cfr);
            }
        }
        $data['floorPlan'] = implode(',',$cfrs);
         $cfrs1 =[];
        if ($request->hasFile('images')) {
            foreach($request->images as $item){
                $cover = $item;
                $extension = $cover->getClientOriginalExtension();
                $cfr = rand(1111,9999) . '.' . $cover->getClientOriginalName();
                Storage::disk('files')->put( $cfr,  
                File::get($cover));
                array_push($cfrs1,$cfr);
            }
        }
        $data['images'] = implode(',',$cfrs1);
                Venue::create($data);
                return redirect('admin/venue');
            }catch(Exception $e){
                return redirect()->back()->with('error', $e->getMessage());
            }
    }
    public function edit(Request $request , $id){
        try{
              $data = Venue::findOrFail($id);
                return view('admin.venues.edit',['data'=>$data]);
            }catch(Exception $e){
                return redirect()->back()->with('error', $e->getMessage());
            }
    }
    public function update(Request $request , $id){
        try{
          
            $data['location_name'] = $request->location_name;
            $data['address'] = $request->address;
            $data['lat'] = $request->lat;
            $data['longitude'] = $request->longitude;
         
            Venue::where('id' , $id)->update($data);
                return redirect('admin/venue');
            }catch(Exception $e){
                return redirect()->back()->with('error', $e->getMessage());
            }
    }

    public function view($id){
        try {
            $data = Venue::findOrFail($id);
         return view('admin.venues.view',['data'=>$data] );
        } catch (Exception $e) {
             return redirect()->back()->with('error', $e->getMessage());
        }
         
      }

    public function delete($id){
        Venue::find($id)->delete();
        return redirect()->route('admin.venue');
    }


    // Add/remove Venue to First Aid  
    public function allowToSite($id){
        
        try {
            $venue = Venue::findOrFail($id);
            
            if($venue->is_site_allow == 0){
                $venue->is_site_allow = 1;
                $message = "Venue Location added to First Aid";
            }else{
                $venue->is_site_allow = 0;
                $message = "Venue Location removed from First Aid";
            }
            $venue->update();

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

}