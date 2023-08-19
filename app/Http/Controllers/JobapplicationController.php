<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobapplicationRequest;
use App\Http\Resources\JobapplicationaResource;
use App\Models\Jobapplication;
use Illuminate\Http\Request;

class JobapplicationController extends Controller
{

    public function show_all_jobapplications()
    {
        $jobapp = Jobapplication::all();
        
        return JobapplicationaResource::collection($jobapp);
    }

    public function create_jobapplications(JobapplicationRequest $request)
    {
        $jobapp = new Jobapplication();
        $jobapp->title = $request->title;
        $jobapp->job_title = $request->jobtitle;
        $jobapp->qualifications = $request->qualifications;
        $jobapp->features = $request->features;
        $jobapp->salary = $request->salary;
        $jobapp->save();
        return response()->json([
            'message' => 'تم انشأ طلب التوظيف بنجاح',
            'jobapp' => new JobapplicationaResource($jobapp),
        ]);
    }


    public function update_jobapplications(JobapplicationRequest $request, $id)
    {
        $jobapp = Jobapplication::find($id);
        $jobapp->title = $request->title;
        $jobapp->job_title = $request->jobtitle;
        $jobapp->qualifications = $request->qualifications;
        $jobapp->features = $request->features;
        $jobapp->salary = $request->salary;
        $jobapp->save();
        return response()->json([
            'message' => 'تم تعديل طلب التوظيف بنجاح',
            'jobapp' => new JobapplicationaResource($jobapp),
        ]);
    }

    public function get_jobapplication($id)
    {
        $jobapp = Jobapplication::find($id);

        return new JobapplicationaResource($jobapp);
    }
}
