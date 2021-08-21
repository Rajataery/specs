<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Quiz;

class QuizController extends Controller
{


  	public function index(){
        try{

            $data["quiz_data"] = Quiz::where('id', 1)->get();
         //dd($data);  
            return view ('quiz.quiz',$data);
        }catch(Exception $e){ 
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function quiz_store(Request $request){
     
            $validator = \Validator::make($request->all(),[
                'question1'     => 'required',
                'question1_1'    => 'required',
                'question2_1'    => 'required',
                'question1_1_1'    => 'required',
                'lastquestion1_1'      => 'required',
                'lastquestion2_1'   => 'required',
                'answer_1'  => 'required',
                'answer_1_1'   => 'required',
                'answer_1_2'     => 'required',
                'question2'   => 'required',
                'question1_2' => 'required',
                'question2_2'  => 'required',
                'question1_2_1'     => 'required',
                'lastquestion1_2'   => 'required',
                'lastquestion2_2'     => 'required',
                'answer_2'    => 'required',
                'answer_2_1' => 'required',
                'answer_2_2' => 'required',
            ]);

            if ($validator->fails()) {
               // die('Validator');
                return redirect()->back()
                    ->withErrors($validator)->withInput($request->all())
                    ->with('error', "Please fill the required fields.");
            }

            $data['mainquestion_1']         =   $request->question1;
            $data['mainquestion_2']    =   $request->question2;
            $data['question1_1']  =   $request->question1_1;
            $data['question2_1']        =   $request->question2_1;
            $data['question2_2_1']     =   $request->question1_1_1;
            $data['lastquestion1_1']    =   $request->lastquestion1_1;
            $data['lastquestion2_1']        =   $request->lastquestion2_1;
            $data['question1_2']        =   $request->question1_2;
            $data['question2_2']        =   $request->question2_2;
            $data['question1_2_1']         =   $request->question1_2_1;
            $data['lastquestion1_2']      =   $request->lastquestion1_2;
            $data['lastquestion2_2']       =   $request->lastquestion2_2;
            $data['answer1_1']          =   $request->answer_1;
            $data['answer1_1_2']   =   $request->answer_1_1;
            $data['answer2_1_2']    =   $request->answer_1_2;
            $data['answer1_2']       =   $request->answer_2;
            $data['answer2_2']   =   $request->answer_2_1;
            $data['answer1_2_2'] =   $request->answer_2_2;
           
           if (empty($request->all())) {
               Quiz::create($data);
            DB::commit();
           }else{
            Quiz::where('id',1)->update($data);
            DB::commit();
           }
           
             
            return redirect ('/thank-you')->with('success', "Quiz created  successfully");
       
    }


   
}
