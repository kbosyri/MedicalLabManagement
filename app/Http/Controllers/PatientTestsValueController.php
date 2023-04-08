<?php

namespace App\Http\Controllers;

use App\GetPatientTestValues\GetPatientTestValues;
use App\Http\Requests\PatientTestValues\AddValuesToTestRequest;
use App\Http\Requests\PatientTestValues\AuditTestRequest;
use App\Http\Resources\patienttestResource;
use App\Models\Patienttest;
use App\Models\PatientTestValue;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;

class PatientTestsValueController extends Controller
{
    public function AddValuesToTest(AddValuesToTestRequest $request,$id)
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

        $test->is_finished = true;

        $test->save();

        return response()->json([
            'message'=>'تم إدخال النتائج بنجاح',
            'test'=>new patienttestResource($test),
        ]);
    }

    public function AuditTest(AuditTestRequest $request,$id)
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

        $test->is_finished = true;

        $test->save();

        return response()->json([
            'message'=>'تم إدخال النتائج بنجاح',
            'test'=>new patienttestResource($test),
        ]);
    }

    public function GetTestValues($id)
    {
        $test = Patienttest::find($id);

        $resource = GetPatientTestValues::GetPatientTestResource($test);

        return response()->json($resource);
    }

    public function seepdf($id)
    {
        $test = Patienttest::find($id);

        $resource = GetPatientTestValues::GetPatientTestResource($test);

        return view("pdf",['values'=>$resource]);
    }

    public function MakePDF($id)
    {
        $test = Patienttest::find($id);

        $resource = GetPatientTestValues::GetPatientTestResource($test);
        
        view()->share('values',$resource);
        error_log("Making View");
        $pdf = PDF::loadView('pdf',$resource);

        error_log("Downloading");
        return $pdf->download('file.pdf');

    }
}
