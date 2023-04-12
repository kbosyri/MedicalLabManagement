<?php

namespace App\Http\Controllers;

use App\Http\Resources\TestReportCollection;
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
}
