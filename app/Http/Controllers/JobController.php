<?php

namespace App\Http\Controllers;

use App\Http\Resources\JobResource;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function show_all_jobapplication(){
        $job=Job::all();
       if($job->count() >0){
        return  JobResource::collection($job);
       }
       else{
        return  response()->json([
            'message'=>'  لا يوجد طلبات توظيف'
              ],500);
       }    
}


    public function store_jobapplication(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'message'=>'required',
            'cv'=>'required|mimes:pdf,doc,docx|max:2048',
        ]);
        $cv=time().'.'.$request->cv->extension();
        $request->cv->move(public_path('uploads'),$cv);
        $job=new Job;
        $job->name=$request->name;
        $job->email=$request->email;
        $job->message=$request->message;
        $job->cv=$request->cv;
        $job->save();
        return response()->json([
            'message'=>' تم ارسال الطلب بنجاح',
            
        ]);
    }
}
