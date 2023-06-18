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
use Illuminate\Support\Facades\DB;

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
            $new_value->unit = $value['unit'];

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
        $test = Patienttest::find($id);
        DB::table('patient_test_values')->where('patient_test_id','=',$id)->delete();
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
            $new_value->unit = $value['unit'];

            $new_value->save();
        }

        $test->is_audited = true;

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
        $resource['web'] = true;

        return view("main_pdf",['values'=>$resource]);
    }

    public function MakePDF($id)
    {
        error_log('test');
        $test = Patienttest::find($id);

        $resource = GetPatientTestValues::GetPatientTestResource($test);
        $resource['web'] = false;
        
        view()->share('values',$resource);
        error_log("Making View");
        $pdf = PDF::loadView('main_pdf',$resource);

        error_log("Downloading");
        $file = $pdf->download('file.pdf');
        error_log('Response');
        return $file;

    }

    public function StreamPDF($id)
    {
        error_log('test');
        $test = Patienttest::find($id);

        $resource = GetPatientTestValues::GetPatientTestResource($test);
        $resource['web'] = false;
        
        view()->share('values',$resource);
        error_log("Making View");
        $pdf = PDF::loadView('main_pdf',$resource);

        error_log("Downloading");
        $file = $pdf->stream('file.pdf');
        error_log('Response');
        return $file;

    }

    public function SendResultToPatient($id)
    {
        $test = Patienttest::find($id);

        $resource = GetPatientTestValues::GetPatientTestResource($test);
        $resource['web'] = true;
        
        view()->share('values',$resource);
        $pdf = PDF::loadView('main_pdf',$resource);

        $file = $pdf->download('file.pdf');

        $test->is_seen = true;
        $test->save();
        
        return $file;
    }
}
