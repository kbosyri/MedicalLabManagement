<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientTests\AddBulkPatientTestsRequest;
use App\Http\Requests\PatientTests\AddPatientTestRequest;
use App\Http\Requests\PatientTests\UpdatePatientTestRequest;
use App\Http\Resources\patienttestResource;
use Illuminate\Http\Request;
use App\Models\Patienttest;
use App\Models\TestsGroup;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PatientTestController extends Controller
{
    private static function Find($id,$array)
    {
        foreach($array as $value)
        {
            if($id == $value)
            {
                return true;
            }
        }
        return false;
    }

    public function add_patient_test(AddPatientTestRequest $request)
    {
        $patienttest=new Patienttest();

        $patienttest->test_date=$request->test_date;
        $patienttest->test_id = $request->test_id;
        $patienttest->patient_id = $request->patient_id;
        $patienttest->staff_id = $request->staff_id;
        $patienttest->save();
        return response()->json([
            'message'=>'تم تسجيل التحاليل المطلوبة بنجاح',
            'test'=>new patienttestResource($patienttest),
              ]); 
    }

    public function AddPatientTests(AddBulkPatientTestsRequest $request)
    {
        $tests = [];
        foreach($request->tests as $test)
        {
            array_push($tests,$test);
        }

        foreach($request->groups as $group)
        {
            $test_group = TestsGroup::find($group);
            foreach($test_group->tests as $test)
            {
                if(!PatientTestController::Find($test->id,$tests))
                {
                    array_push($tests,$test->id);
                }
            }
        }

        $resource = [];
        foreach($tests as $test)
        {
            $patienttest=new Patienttest();

            $patienttest->test_date=$request->test_date;
            $patienttest->test_id = $test;
            $patienttest->patient_id = $request->patient_id;
            $patienttest->staff_id = $request->staff_id;
            $patienttest->save();

            array_push($resource,$patienttest);
        }

        return response()->json([
            'message'=>"تم إضافة التحاليل المطلوبة",
            "tests"=>patienttestResource::collection($resource),
        ]);
    }

    public function update_patient_test(UpdatePatientTestRequest $request, $id)
    {
        $patienttest=Patienttest::find($id);
        $patienttest->test_date=$request->test_date;
        $patienttest->test_id = $request->test_id;
        $patienttest->patient_id = $request->patient_id;
        $patienttest->staff_id = $request->staff_id;
        $patienttest->save();
        return response()->json([
            'message'=>'تم تعديل  التحليل المطلوب بنجاح',
            'test'=>new patienttestResource( $patienttest),
              ]); 
    }

    public function GetStaffPatientTests()
    {
        $patienttests = Patienttest::where('staff_id',Auth::user()->id)->where('is_finished',false)->latest()->get();
        
        return patienttestResource::collection($patienttests);
    }

    public function GetUnAuditedTests()
    {
        $tests = Patienttest::where('is_audited',false)->where('is_finished',true)->get();

        return patienttestResource::collection($tests);
    }

    public function GetUserTests()
    {
        $tests = Patienttest::where('patient_id',Auth::user()->id)->where('is_audited',true)->get();

        return patienttestResource::collection($tests);
    }

    public function GetPatientTests($id)
    {
        $tests = Patienttest::where('patient_id',$id)->where('is_finished',false)->get();

        return patienttestResource::collection($tests);
    }

    public function GetPatientTest($id)
    {
        $test = Patienttest::find($id);

        return new patienttestResource($test);
    }

    public function GetStaffRecentPatinets()
    {
        $patienttests = DB::table('patienttests')
        ->where('patienttests.staff_id','=',Auth::user()->id)
        ->where('patienttests.is_finished','=',false)
        ->orderByDesc('patienttests.created_at')
        ->join('patients','patienttests.patient_id','=','patients.id')
        ->distinct('patients.id')
        ->select(['patients.id','patients.First_Name','patients.Last_Name','patients.Father_Name'])->get();

        return response()->json(['patients'=>$patienttests]);
    }

    public function GetRecentPatinets()
    {
        $patienttests = DB::table('patienttests')
        ->orderByDesc('patienttests.created_at')
        ->join('patients','patienttests.patient_id','=','patients.id')
        ->distinct('patients.id')
        ->select(['patients.id','patients.First_Name','patients.Last_Name','patients.Father_Name'])->get();

        return response()->json(['patients'=>$patienttests]);
    }

    public function GetUnseen()
    {
        $tests = Patienttest::where('patient_id',Auth::user()->id)->where('is_finished',true)->where('is_seen',false)->get();

        return patienttestResource::collection($tests);
    }

    public function GetArchive()
    {
        $tests = Patienttest::where('patient_id',Auth::user()->id)->where('is_finished',true)->where('is_seen',true)->get();

        return patienttestResource::collection($tests);
    }
}

