<?php

namespace App\Http\Controllers;

use App\Http\Requests\Reports\ReportRequest;
use App\Http\Resources\PatientTestsReportCollection;
use App\Http\Resources\Reports\StaffTestsReportCollection;
use App\Http\Resources\TestReportCollection;
use App\Models\Patient;
use App\Models\Patienttest;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestReportController extends Controller
{
    public function GetTestReport(ReportRequest $request)
    {
        $tests = Patienttest::whereBetween('test_date',[$request->start_date,$request->end_date]);

        if($request->name)
        {
            $temp = DB::table('tests')->select(['id'])->where('name','like',$request->name."%")->get();
            $array = [];
            foreach($temp as $test)
            {
                array_push($array,$test->id);
            }
            $tests = $tests->whereIn('test_id',$array);
        }
        if($request->arabic_name)
        {
            $temp = DB::table('tests')->select(['id'])->where('arabic_name','like',$request->arabic_name."%")->get();
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

    public function GetPatientTests(ReportRequest $request)
    {
        $tests = Patienttest::whereBetween('test_date',[$request->start_date,$request->end_date]);

        if($request->first_name)
        {
            $temp = DB::table('patients')->select(['id'])->where('First_Name','like',$request->first_name."%")->get();
            $array = [];
            foreach($temp as $patient)
            {
                array_push($array,$patient->id);
            }
            $tests = $tests->whereIn('patient_id',$array);
        }

        if($request->father_name)
        {
            $temp = DB::table('patients')->select(['id'])->where('Father_Name','like',$request->father_name."%")->get();
            $array = [];
            foreach($temp as $patient)
            {
                array_push($array,$patient->id);
            }
            $tests = $tests->whereIn('patient_id',$array);
        }

        if($request->last_name)
        {
            $temp = DB::table('patients')->select(['id'])->where('Last_Name','like',$request->last_name."%")->get();
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

    public function GetStaffTests(ReportRequest $request)
    {
        $tests = Patienttest::whereBetween('test_date',[$request->start_date,$request->end_date]);
        
        if($request->first_name)
        {
            $temp = DB::table('staff')->select(['id'])->where('first_name','like',$request->first_name."%")->get();
            $array = [];
            foreach($temp as $staff)
            {
                array_push($array,$staff->id);
            }
            $tests = $tests->whereIn('staff_id',$array);
        }

        if($request->father_name)
        {
            $temp = DB::table('staff')->select(['id'])->where('father_name','like',$request->father_name."%")->get();
            $array = [];
            foreach($temp as $staff)
            {
                array_push($array,$staff->id);
            }
            $tests = $tests->whereIn('staff_id',$array);
        }

        if($request->last_name)
        {
            $temp = DB::table('staff')->select(['id'])->where('last_name','like',$request->last_name."%")->get();
            $array = [];
            foreach($temp as $staff)
            {
                array_push($array,$staff->id);
            }
            $tests = $tests->whereIn('staff_id',$array);
        }

        $tests = $tests->get();

        return new StaffTestsReportCollection($tests);
    }
}
