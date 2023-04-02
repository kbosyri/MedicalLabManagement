<?php

namespace App\Http\Controllers;

use App\Http\Resources\patienttestResource;
use App\Models\Patienttest;
use App\Models\PatientTestValue;
use Illuminate\Http\Request;

class PatientTestsValueController extends Controller
{
    public function AddValuesToTest(Request $request,$id)
    {
        foreach($request->values as $value)
        {
            $new_value = new PatientTestValue();

            $new_value->patient_test_id = $id;
            if($value['is_category_element'])
            {
                $new_value->category_element_id = $value['element_id'];
                $new_value->is_category_element = true;
            }
            else
            {
                $new_value->element_id = $value['element_id'];
            }
            $new_value->value = $value['value'];

            $new_value->save();
        }

        $test = Patienttest::find($id);

        return response()->json([
            'message'=>'تم إدخال النتائج بنجاح',
            'test'=>new patienttestResource($test),
        ]);
    }

    public function GetTestValues($id)
    {
        $test = Patienttest::find($id);

        $resource = $test->GetResource();
    }
}
