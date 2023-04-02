<?php

namespace App\Http\Controllers;

use App\Http\Resources\patienttestResource;
use Illuminate\Http\Request;
use App\Models\Patienttest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PatientTestController extends Controller
{
    public function add_patient_test(Request $request)
    {
        $patienttest=new Patienttest();

        $patienttest->test_date=$request->test_date;
        $patienttest->test_id = $request->test_id;
        $patienttest->patient_id = $request->patient_id;
        $patienttest->staff_id = $request->staff_id;
        $patienttest->save();
        return response()->json([
            'message'=>'تم تسجيل التحاليل المطلوبة بنجاح',
              ],500); new patienttestResource($patienttest); 
    }



    public function update_patient_test(Request $request, $id)
    {
        $patienttest=Patienttest::find($id);
        $patienttest->test_date=$request->test_date;
        $patienttest->test_id = $request->test_id;
        $patienttest->patient_id = $request->patient_id;
        $patienttest->staff_id = $request->staff_id;
        $patienttest->save();
        return response()->json([
            'message'=>'تم تعديل  التحاليل المطلوبة بنجاح',
              ],500); new patienttestResource( $patienttest); 
    }

    public function GetStaffPatientTests()
    {
        $patienttests = Patienttest::where('staff_id',Auth::user()->id)->where('is_finished',false)->get();
        
        return patienttestResource::collection($patienttests);
    }

    public function GetUnAuditedTests()
    {
        $tests = Patienttest::where('is_audited',false)->where('is_finished',true)->get();

        return patienttestResource::collection($tests);
    }

    public function GetPatientTests()
    {
        $tests = Patienttest::where('patient_id',Auth::user()->id)->where('is_audited',true);

        return patienttestResource::collection($tests);
    }
}
