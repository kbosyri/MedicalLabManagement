<?php

namespace App\Http\Controllers;

use App\Http\Resources\StaffResource;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StaffAccountsController extends Controller
{
    public function RegisterStaff(Request $request)
    {
        $new_staff = new Staff();

        $new_staff->first_name = $request->first_name;
        $new_staff->father_name = $request->father_name;
        $new_staff->last_name = $request->last_name;
        $new_staff->username = $request->username;
        $new_staff->qualifications = $request->qualifications;
        $new_staff->password = Hash::make($request->password);

        if($request->admin)
        {
            $new_staff->admin = $request->admin;
        }

        else if($request->is_lab_staff)
        {
            $new_staff->is_lab_staff = $request->is_lab_staff;
        }

        else if($request->is_reception)
        {
            $new_staff->is_reception = $request->is_reception;
        }

        $new_staff->save();

        return new StaffResource($new_staff);
    }

    public function ChangePassword(Request $request)
    {
        $user = $request->user('staff');
        if(!Hash::check($request->old_password,$user->password))
        {
            return response()->json(['message'=>'كلمة السر القديمة غير متطابقة'],400);
        }
        
        $user->password = Hash::make($request->new_password);

        return response()->json(['message'=>'تم تغيير كلمة السر بنجاح']);
    }

    public function GetAllStaff()
    {
        $staff = Staff::where('is_active',true)->get();

        return StaffResource::collection($staff);
    }

    public function GetStaff($id)
    {
        $staff = Staff::find($id);

        return new StaffResource($staff);
    }

    public function UpdateStaff(Request $request, $id)
    {
        $staff = Staff::find($id);

        $staff->first_name = $request->first_name;
        $staff->father_name = $request->father_name;
        $staff->last_name = $request->last_name;
        $staff->username = $request->username;
        $staff->qualifications = $request->qualifications;
        
        $staff->save();

        return new StaffResource($staff);
    }

    public function LoginStaff(Request $request)
    {
        $staff = Staff::where('username',$request->username)->first();
        
        if(!Auth::guard('staff')->attempt(['username'=>$request->username,'password'=>$request->password],true))
        {
            return response()->json(['message'=>'بيانات تسجيل الدخول غير صحيحة'],400);
        }

        $token = $staff->createToken('authtoken')->plainTextToken;

        return response()->json([
            'token'=> $token,
            'staff'=> new StaffResource($staff),
        ]);
    }

    public function LogoutStaff(Request $request)
    {
        $request->user('staff')->currentAccessToken()->delete();
        return response()->json([
            'message'=>'تم تسجيل الخروج'
        ]);
    }

    public function TerminateStaff($id)
    {
        $staff = Staff::find($id);

        $staff->is_active = false;

        $staff->save();

        return response()->json([
            'staff'=>new StaffResource($staff),
            'message'=>'تم إلغاء حساب الموظف',
        ]);
    }
}
