<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Patient;
//
use App\Http\Requests\PatientLoginRequest;
use App\Http\Requests\PatientPasswordChangeRequest;
use App\Http\Requests\PatientRegisterRequest;
use App\Http\Requests\PatientreisterRequest;
use App\Http\Resources\PatientResource;
use App\Models\Patienttest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;










class PatientController extends Controller
{

    public function index(){
        $patient=Patient::all()->where('is_active',true);
       if($patient->count() >0){
        return  PatientResource::collection($patient);
       }
       else{
        return  response()->json([
            'message'=>' لا يوجد سجلات للمرضى '
              ],500);
       }    

    }

    public function GetSpecificPatient($id)
    {
        $patient = Patient::find($id);
        
        return new PatientResource($patient);
    }

    public function createpatient(Request $request){
        $patient=new patient;
        $patient->First_Name=$request->First_Name;
        $patient->Last_Name=$request->Last_Name;
        $patient->Father_Name=$request->Father_Name;
        $patient->Gender=$request->Gender;
        $patient->Date_Of_Birth=$request->Date_Of_Birth;
        $patient->username=$request->username;
        $patient->password=Hash::make($request->password);
        $patient->email=$request->email;
        $patient->phone=$request->phone;
        $patient->save();
        return response()->json([
            'message'=>'تم انشأ الحساب بنجاح',
            'patient'=>new patientResource($patient),
              ]); 
    }





    public function updatepatient (Request $request,$id){
        $patient=patient::find($id);
        $patient->First_Name=$request->First_Name;
        $patient->Last_Name=$request->Last_Name;
        $patient->Father_Name=$request->Father_Name;
        $patient->Gender=$request->Gender;
        $patient->Date_Of_Birth=$request->Date_Of_Birth;
        $patient->username=$request->username;
        $patient->email=$request->email;
        $patient->phone=$request->phone;
        $patient->save();
        return  response()->json([
            'message'=>'تم تعديل معلومات الحساب بنجاح',
            'patient'=>new patientResource($patient),
            ]); 
        
    }

    


    public function deletepatient ($id)
    {
        $patient = Patient::find($id);

        $patient->is_active = false;
        $patient->Deactivation_Date = Carbon::now();

        $patient->save();

        response()->json([
            'message'=>'تم إلغاء تفعيل الحساب بنجاح',
        ]);

    }

    public function GetUser()
    {
        $user = Patient::find(Auth::user()->id);

        return new PatientResource($user);
    }

   public function Registerpatient(PatientreisterRequest $request)
    {
        $patient = new Patient();

        $patient->First_Name=$request->First_Name;
        $patient->Last_Name=$request->Last_Name;
        $patient->Father_Name=$request->Father_Name;
        $patient->Gender=$request->Gender;
        $patient->Date_Of_Birth=$request->Date_Of_Birth;
        $patient->username=$request->username;
        $patient->password=Hash::make($request->password);
        

        if($request->email)
        {
            $patient->email = $request->email;
        }
        if($request->phone)
        {
            $patient->phone = $request->phone;
        }

        $patient->save();

        return  response()->json([
            'message'=>'  تم تسجيل المريض بنجاح',
            'patient'=>new patientResource($patient)
            ],200); 
    }


    public function Loginpatient(PatientloginRequest $request)
    {
        $patient = Patient::where('username',$request->username)->where('is_active',true)->first();
        
        if(!Auth::attempt(['username'=>$request->username,'password'=>$request->password],true))
        {
            return response()->json(['message'=>'بيانات تسجيل الدخول غير صحيحة'],400);
        }

        $token = $patient->createToken('authtoken')->plainTextToken;

        return response()->json([
            'token'=> $token,
            'message'=>'تم تسجيل الدخول بنجاح',
            'patient'=> new PatientResource($patient),
        ]);
    }

    public function Logoutpatient(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message'=>'تم تسجيل الخروج',
        ]);
    }


    public function ChangePassword(PatientPasswordChangeRequest $request)
    {
        $user = patient::find(Auth::user()->id);

        if($request->confirm_password != $request->new_password)
        {
            return response()->json(['message'=>'كلمة السر الجديدة غير متطابقة مع تأكيد كلمة السر'],400);
        }

        if(!Hash::check($request->old_password,$user->password))
        {
            return response()->json(['message'=>'كلمة السر القديمة غير متطابقة'],400);
        }
        
        $user->password = Hash::make($request->new_password);

        $user->save();

        return response()->json(['message'=>'تم تغيير كلمة السر بنجاح']);
    }

    public function GetPatientsWithTests()
    {
        $patients_id = Patienttest::all()->pluck('patient_id')->unique();

        $patients = Patient::whereIn('id',$patients_id)->get();

        return PatientResource::collection($patients);
    }

}


    



