<?php

namespace App\Http\Controllers;

use App\Models\Element;
use App\Models\ElementValueRange;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestsController extends Controller
{

    public function AddTest(Request $request)
    {
        $new_test = new Test();

        $new_test->name = $request->name;
        $new_test->arabic_name = $request->arabic_name;
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
}
