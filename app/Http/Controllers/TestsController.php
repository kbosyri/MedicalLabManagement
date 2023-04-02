<?php

namespace App\Http\Controllers;

use App\Http\Resources\Tests\TestGroupResource;
use App\Http\Resources\Tests\TestGroupTestResource;
use App\Http\Resources\Tests\TestResource;
use App\Models\Element;
use App\Models\ElementValueRange;
use App\Models\Test;
use App\Models\TestsGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestsController extends Controller
{

    public function AddTest(Request $request)
    {
        $new_test = new Test();

        $new_test->name = $request->name;
        $new_test->arabic_name = $request->arabic_name;
        $new_test->overview = $request->overview;
        $new_test->preconditions = $request->preconditions;
        $new_test->symbol = $request->symbol;
        $new_test->cost = $request->cost;

        $new_test->save();

        $elements = [];

        foreach($request->elements as $element)
        {
            array_push($elements,['element_id'=>$element,'test_id'=>$new_test->id]);
        }

        DB::table('test_elements')->insert($elements);

        return response()->json([
            'message'=>"تم إضافة التحليل بنجاح",
        ]);
    }

    public function AddTestGroup(Request $request)
    {
        $group = new TestsGroup();

        $group->name = $request->name;

        $group->save();

        $tests = [];

        foreach($request->tests as $test)
        {
            array_push($tests,['tests_group_id'=>$group->id,'test_id'=>$test]);
        }

        DB::table('test_group_tests')->insert($tests);

        return response()->json([
            'message'=>'تم إضافة مجموعة التحاليل بنجاح'
        ]);
    }

    public function DeleteTest($id)
    {
        $test = Test::find($id);

        DB::table('test_elements')->where('test_id','=',$test->id)->delete();

        DB::table('test_group_tests')->where('test_id','=',$test->id)->delete();

        $test->delete();

        return response()->json([
            'message'=>'تم حذف التحليل'
        ]);
    }

    public function DeleteTestGroup($id)
    {
        $group = TestsGroup::find($id);

        DB::table('test_group_tests')->where('tests_group_id','=',$group->id)->delete();

        $group->delete();

        return response()->json([
            'message'=>'تم حذف مجموعة التحاليل'
        ]);
    }

    public function GetTests()
    {
        $tests = Test::all();

        return TestResource::collection($tests);
    }

    public function GetTest($id)
    {
        $test = Test::find($id);

        return new TestResource($test);
    }

    public function GetTestGroups()
    {
        $groups = TestsGroup::all();

        return TestGroupResource::collection($groups);
    }

    public function GetTestGroup($id)
    {
        $group = TestsGroup::find($id);

        return new TestGroupResource($group);
    }

    public function GetGroupTests($id)
    {
        $group = TestsGroup::find($id);

        return TestGroupTestResource::collection($group->tests);
    }

    public function UpdateTestsGroup(Request $request, $id)
    {
        $group = TestsGroup::find($id);

        $group->name = $request->name;

        $group->save();

        DB::table('test_group_tests')->where('tests_group_id','=',$id)->delete();

        $tests = [];

        foreach($request->tests as $test)
        {
            array_push($tests,['tests_group_id'=>$group->id,'test_id'=>$test]);
        }

        DB::table('test_group_tests')->insert($tests);

        return response()->json([
            'message'=>'تم تعديل مجموعة التحاليل بنجاح'
        ]);
    }

    public function updateTest(Request $request, $id)
    {
        $test = Test::find($id);

        $test->name = $request->name;
        $test->arabic_name = $request->arabic_name;
        $test->overview = $request->overview;
        $test->preconditions = $request->preconditions;
        $test->symbol = $request->symbol;
        $test->cost = $request->cost;

        $test->save();

        DB::table('test_elements')->where('test_id','=',$id)->delete();

        $elements = [];

        foreach($request->elements as $element)
        {
            array_push($elements,['element_id'=>$element,'test_id'=>$test->id]);
        }

        DB::table('test_elements')->insert($elements);

        return response()->json([
            'message'=>"تم تعديل التحليل بنجاح",
        ]);
    }
}
