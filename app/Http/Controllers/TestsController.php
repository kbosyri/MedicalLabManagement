<?php

namespace App\Http\Controllers;

use App\Models\Element;
use App\Models\ElementValueRange;
use Illuminate\Http\Request;

class TestsController extends Controller
{
    public function ElementsPage()
    {
        return view('elements');
    }

    public function AddElement(Request $request)
    {
        $element = new Element();

        $element->name = $request->name;
        $element->arabic_name = $request->arabic_name;
        $element->symbol = $request->symbol;
        $element->is_value = $request->is_value;
        $element->is_percentage = $request->is_percentage;
        $element->is_exist = $request->is_exist;

        $element->save();

        $ranges = array();

        foreach($request->ranges as $range)
        {
            $range['id'] = $element->id;
            array_push($ranges,$range);
        }

        ElementValueRange::insert($ranges);

        return response()->json(['message'=>'success']);
    }
}
