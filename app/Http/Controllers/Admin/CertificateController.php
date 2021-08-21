<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use  App\Certificate;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin-web');
    }
    
    
    public function index()
    {
    	$certificates = Certificate::with('course')->get();
    	return view('admin.certificates.index', compact('certificates'));
    	
    }

    public function create()
    {
      	try{
      		$courses = Course::all();
          	return view('admin.certificates.create', compact('courses'));
     	}catch( \Exception $e){
           return redirect()->route('admin.certificates');
     	}
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
        	$validator = \Validator::make($request->all(),[
                "name"=> 'required|max:256',
                "course_id"=> 'required',
                "template"=> 'required|min:50'
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                	->withInput($request->all())
                    ->withErrors($validator);
            }

            $data = $request->all();
            Certificate::create($data);
            DB::commit();
            return  redirect()->route('admin.certificates')->with('success', "Certificate created successfully");
        }catch( \Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function view($id)
    {
    	try {
		    $certificate = Certificate::with('course')->where('id', $id)->firstOrFail();
		    $logo= config('app.url').'/frontend/images/First-aid-Guru-dark-logo.svg';
		    return view('admin.certificates.view',compact('certificate', 'logo'));
	    }catch(\Exception $e){
            return redirect()->route('admin.certificates')->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        try{
            $certificate =  Certificate::findOrFail($id);
            $courses = Course::all();
            return view('admin.certificates.edit', compact('certificate','courses'));
        }catch( \Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update(Request $request , $id)
    {
        DB::beginTransaction();
        try{
        	$validator = \Validator::make($request->all(),[
                "name"=> 'required|max:256',
                "course_id"=> 'required',
                "template"=> 'required|min:50'
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                	->withInput($request->all())
                    ->withErrors($validator);
            }
            $certificate = Certificate::findOrFail($id);
            $data = $request->all();
            $certificate->update($data);
            DB::commit();
            return redirect()->route('admin.certificates')->with('success', "Certificate updated successfully");
        }catch( \Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete($id)
    {
    	try{
    		Certificate::findOrFail($id)->delete();
    		return redirect()->route('admin.certificates')->with('success', "Certificate deleted");

    	}catch( \Exception $e){
            return redirect()->route('admin.certificates')->with('error', $e->getMessage());
        }      	
    }

    public function issueCertificate()
    {
        try{
            $certificates = Certificate::all();
            $courses = Course::all();
            return view('admin.certificates.issue-certificate', compact('certificates','courses'));

        }catch( \Exception $e){
            return redirect()->route('admin.certificates')->with('error', $e->getMessage());
        }

    }

    public function getCertificate($course_id)
    {
        try{
            if($course_id){
                $certificates = Certificate::where("course_id", $course_id)->get();

                $response = [
                    "message" => "Success",
                    "certificates"  => $certificates,
                    "status" => 1
                ];
                return response()->json($response, 200);
            }else{
                $response = [
                    "message" => "Please select a course.",
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

   /* 
    $logo   = $logo= config('app.url').'/frontend/images/First-aid-Guru-dark-logo.svg';
    <img src='".$logo."' style='width:200px' />
    $variables = array(
        '{SITE_LOGO}' => '<img style="width: 250px;" src="'.$logo.'" alt="site_logo">',
        '{COURSE_TYPE}'    => 'COURSE_TYPE',
        '{COURSE_DATE}'    => 'COURSE_DATE',
        '{COURSE_DAYS}'    => 'COURSE_DAYS',
        '{COURSE_NAME}'    => 'COURSE_NAME',
        '{TRAINEE_NAME}'   => 'TRAINEE_NAME',
        '{COURSE_ADDRESS}' => 'COURSE_ADDRESS',
        '{CERTIFICATE_ISSUE_DATE}' => '{CERTIFICATE_ISSUE_DATE}'
    );

    $template = strtr($template, $variables);
    */
}
