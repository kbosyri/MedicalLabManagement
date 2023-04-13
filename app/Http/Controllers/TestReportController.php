<?php

namespace App\Http\Controllers;

use App\Http\Resources\PatientTestsReportCollection;
use App\Http\Resources\TestReportCollection;
use App\Models\Patient;
use App\Models\Patienttest;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestReportController extends Controller
{
    public function GetTestReport(Request $request)
    {
        $tests = Patienttest::whereBetween('created_at',[$request->start_date,$request->end_date]);

        if($request->name)
        {
            $temp = DB::table('tests')->select(['id'])->where('name','=',$request->name)->get();
            $array = [];
            foreach($temp as $test)
            {
                array_push($array,$test->id);
            }
            $tests = $tests->whereIn('test_id',$array);
        }
        if($request->arabic_name)
        {
            $temp = DB::table('tests')->select(['id'])->where('arabic_name','=',$request->arabic_name)->get();
            $array = [];
            foreach($temp as $test)
            {
                array_push($array,$test->id);
            }
            $tests = $tests->whereIn('test_id',$array);
        }

        $tests = $tests->get();
        return new TestReportCollection($tests);
    }

    public function GetPatientTests(Request $request)
    {
        $tests = Patienttest::whereBetween('created_at',[$request->start_date,$request->end_date]);

        if($request->first_name)
        {
            $temp = DB::table('patients')->select(['id'])->where('First_Name','=',$request->name)->get();
            $array = [];
            foreach($temp as $patient)
            {
                array_push($array,$patient->id);
            }
            $tests = $tests->whereIn('patient_id',$array);
        }

        if($request->father_name)
        {
            $temp = DB::table('patients')->select(['id'])->where('Father_Name','=',$request->father_name)->get();
            $array = [];
            foreach($temp as $patient)
            {
                array_push($array,$patient->id);
            }
            $tests = $tests->whereIn('patient_id',$array);
        }

        if($request->last_name)
        {
            $temp = DB::table('patients')->select(['id'])->where('Last_Name','=',$request->last_name)->get();
            $array = [];
            foreach($temp as $patient)
            {
                array_push($array,$patient->id);
            }
            $tests = $tests->whereIn('patient_id',$array);
        }

        if($request->gender)
        {
            $temp = DB::table('patients')->select(['id'])->where('Gender','=',$request->gender)->get();
            $array = [];
            foreach($temp as $patient)
            {
                array_push($array,$patient->id);
            }
            $tests = $tests->whereIn('patient_id',$array);
        }

        $tests = $tests->get();

        return new PatientTestsReportCollection($tests);
    }

    public function GetStaffTests(Request $request)
    {
        $tests = Patienttest::whereBetween('created_at',[$request->start_date,$request->end_date]);
        
        if($request->first_name)
        {
            $temp = DB::table('staff')->select(['id'])->where('first_name','=',$request->name)->get();
            $array = [];
            foreach($temp as $staff)
            {
                array_push($array,$staff->id);
            }
            $tests = $tests->whereIn('staff_id',$array);
        }

        if($request->father_name)
        {
            $temp = DB::table('staff')->select(['id'])->where('father_name','=',$request->father_name)->get();
            $array = [];
            foreach($temp as $staff)
            {
                array_push($array,$staff->id);
            }
            $tests = $tests->whereIn('staff_id',$array);
        }

        if($request->last_name)
        {
            $temp = DB::table('staff')->select(['id'])->where('last_name','=',$request->last_name)->get();
            $array = [];
            foreach($temp as $staff)
            {
                array_push($array,$staff->id);
            }
            $tests = $tests->whereIn('staff_id',$array);
        }
    }
}
