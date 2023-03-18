<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Patient;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{

    public function index(){
       /* $patient=Patient::all();
       if($patient->count() >0){
        return  response()->json([
            'statuse'=>200,
            'patient'=>$patient
              ],200);
       }
       else{
        return  response()->json([
            'statuse'=>404,
            'message'=>'No Records Found'
              ],404);
       }*/

       $patient=Patient::all();
       return  response()->json([
        'patients'=>$patient
          ],200);

    }


    public function create(Request $request){
        $patient=new patient;
        $patient->First_Name=$request->First_Name;
        $patient->Last_Name=$request->Last_Name;
        $patient->Father_Name=$request->Father_Name;
        $patient->Gender=$request->Gender;
        $patient->Date_Of_Birth=$request->Date_Of_Birth;
        $patient->save();
        return new patientResource($new_patient); 
    }


    public function edit ($id){
        $patient=patient::find($id);
        return new patientResource($new_patient); 
        ;
        
    }


    public function ubdate (Request $request,$id){
        $patient=patient::find($id);
        $patient->First_Name=$request->First_Name;
        $patient->Last_Name=$request->Last_Name;
        $patient->Father_Name=$request->Father_Name;
        $patient->Gender=$request->Gender;
        $patient->Date_Of_Birth=$request->Date_Of_Birth;
        $patient->save();
        return new patientResource($new_patient); 
        ;
        
    }



    public function delete ($id){
        $patient = Patient::find($id);

        $patient->is_active = false;
        $patient->Deactive_Date = Carbon::now();

        $patient->save();

        return response()->json([
            'message'=>'تم إلغاء تفعيل الحساب بنجاح',
        ]);

    }//returne--------


    public function store (storePatientRequest $request){
        try {
            patient::create($request->all());
            return redirect()->back()->with('success','Data saved successfully');
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }

$validator=validator::make($request->all(),)

    }


    



}
