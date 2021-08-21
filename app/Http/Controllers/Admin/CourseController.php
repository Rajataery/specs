<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Course;
use App\CourseUnit;
use App\Inhouse;
use Storage;
use File;
use App\CourseType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin-web');
    }
    
    public function index()
    {
        try{
            $data = Course::latest()->get();
            return view('admin.courses.index', ['data'=>$data]);
        }catch( Exception $e){
            return redirect()->route('admin.courses');
        }
    }
    public function create()
    {
      try{
          return view('admin.courses.create');
         }catch( Exception $e){
           return redirect()->route('admin.courses');
         }
    }
    public function store(Request $request)
    {
        DB::beginTransaction();
        $request->validate([
            "course_name"=> 'required|max:100',
            "course_title"=> 'required|max:100',
            "short_discription"=> 'required|max:400',
            "course_discription"=> 'required|max:500',
            "course_time"=> 'required|max:100',
            "about_individuals_description"=> 'required',
            "about_organisations_description"=> 'required',
            "course_image"=> 'required|file',
            "price_1_12"=> 'numeric|min:1',
            "price_12_24"=> 'numeric|min:1',
            "price_24_36"=> 'numeric|min:1',
            "public_price" => 'required|max:100',
            "duration" => 'required|max:100',
            "description" => 'required|max:500',
            "other" => 'required|max:500',
        ]);

        try{
            $data = array();
            $data = $request->except('course_unit');
            if($request->hasFile('course_image')) {
              $image = $request->file('course_image');
              $name = time() . '.' . $image->getClientOriginalExtension();
              $destinationPath = public_path('/frontend/images');
              $img = Image::make($image->getRealPath());
              $img->resize(500, 500, function ($constraint) {
                  $constraint->aspectRatio();
              })->save($destinationPath.'/'. $name);
              $data['course_image'] = $name;
            }
            if($request->hasFile('course_file')) {
               $cover = $request->file('course_file');
                $extension = $cover->getClientOriginalExtension();
                $data['course_file'] = $cover->getClientOriginalName();
                Storage::disk('files')->put( $cover->getClientOriginalName(),  
                File::get($cover));
            }

            $course = Course::create($data);
            if (isset($request->course_unit)) {
                foreach ($request->course_unit as $key => $unit) {
                    if($unit){
                        CourseUnit::create([
                            'course_id' => $course->id,
                            'name'      => $unit
                        ]);
                    }
                }
            }

            DB::commit();
            return  redirect()->route('admin.courses')->with('success', "Course created successfully");
        }catch( Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function view($id){
        try{
            $item = Course::with('units')->where('id', $id)->firstorFail();
            return view('admin.courses.view',compact('item'));
        }catch( Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
       }
    }

    public function edit($id){
     
      try{
            $course =  Course::with('units')->where('id', $id)->firstorFail();
            return view('admin.courses.edit', ['data'=>$course]);
       }catch( Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
       }
    }

    

    public function update(Request $request , $id)
    {
        DB::beginTransaction();
        $request->validate([
            "course_name"=> 'required|max:100',
            "course_title"=> 'required|max:100',
            "short_discription"=> 'required|max:400',
            "course_discription"=> 'required|max:500',
            "course_time"=> 'required|max:100',
            "about_individuals_description"=> 'required',
            "about_organisations_description"=> 'required',
            "price_1_12"=> 'numeric|min:1',
            "price_12_24"=> 'numeric|min:1',
            "price_24_36"=> 'numeric|min:1',
            "public_price" => 'required|max:100',
            "duration" => 'required|max:100',
            "description" => 'required|max:500',
            "other" => 'required|max:500',
        ]);

        try{

            $course = Course::findOrFail($id);
            $data = $request->except('course_unit');

            if ($request->hasFile('course_image')) {
                $image = $request->file('course_image');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/frontend/images');
                $img = Image::make($image->getRealPath());
                $img->resize(500, 500, function ($constraint) {
                  $constraint->aspectRatio();
                })->save($destinationPath.'/'. $name);
                $data['course_image'] = $name;
            }
            if ($request->hasFile('course_file')) {
                $cover = $request->file('course_file');
                $extension = $cover->getClientOriginalExtension();
                $data['course_file'] = $cover->getClientOriginalName();
                Storage::disk('files')->put( $cover->getClientOriginalName(),  
                File::get($cover));
            }

            $course->update($data);

            if (isset($request->course_unit)) {
                CourseUnit::where('course_id', $course->id)->delete();
                foreach ($request->course_unit as $key => $unit) {
                    if($unit){
                        CourseUnit::create([
                            'course_id' => $course->id,
                            'name'      => $unit
                        ]);
                    }
                }
            }

            DB::commit();
            return redirect()->route('admin.courses')->with('success', "Course updated successfully");
        }catch( Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete($id) {

        $course =  Course::find($id)->delete();
        CourseUnit::where('course_id', $id)->delete();
        return redirect()->route('admin.courses')->with('success', "course deleted");
      
    }

    

}
