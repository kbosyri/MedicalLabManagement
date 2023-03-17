<?php

namespace App\Http\Controllers;

use App\Http\Requests\StaffLoginRequest;
use App\Http\Requests\StaffPasswordChangeRequest;
use App\Http\Requests\StaffRegisterRequest;
use App\Http\Requests\StaffUpdateRequest;
use App\Http\Resources\StaffResource;
use App\Models\Staff;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StaffAccountsController extends Controller
{
    public function RegisterStaff(StaffRegisterRequest $request)
    {
        $new_staff = new Staff();

        $new_staff->first_name = $request->first_name;
        $new_staff->father_name = $request->father_name;
        $new_staff->last_name = $request->last_name;
        $new_staff->username = $request->username;
        $new_staff->qualifications = $request->qualifications;
        $new_staff->password = Hash::make($request->password);

        if($request->is_admin)
        {
            $new_staff->is_admin = $request->admin;
        }

        else if($request->is_lab_staff)
        {
            $new_staff->is_lab_staff = $request->is_lab_staff;
        }

        else if($request->is_reception)
        {
            $new_staff->is_reception = $request->is_reception;
        }

        if($request->email)
        {
            $new_staff->email = $request->email;
        }
        if($request->phone)
        {
            $new_staff->phone = $request->phone;
        }

        $new_staff->save();

        return new StaffResource($new_staff);
    }

    public function ChangePassword(StaffPasswordChangeRequest $request)
    {
        $user = Staff::find(Auth::user()->id);
        if(!Hash::check($request->old_password,$user->password))
        {
            return response()->json(['message'=>'كلمة السر القديمة غير متطابقة'],400);
        }
        
        $user->password = Hash::make($request->new_password);

        $user->save();

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

    public function UpdateStaff(StaffUpdateRequest $request, $id)
    {
        $staff = Staff::find($id);

        $staff->first_name = $request->first_name;
        $staff->father_name = $request->father_name;
        $staff->last_name = $request->last_name;
        $staff->username = $request->username;
        $staff->qualifications = $request->qualifications;

        if($request->email)
        {
            $staff->email = $request->email;
        }
        if($request->phone)
        {
            $staff->phone = $request->phone;
        }
        
        $staff->save();

        return new StaffResource($staff);
    }

    public function LoginStaff(StaffLoginRequest $request)
    {
        $staff = Staff::where('username',$request->username)->where('is_active',true)->first();
        
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
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message'=>'تم تسجيل الخروج'
        ]);
    }

    public function TerminateStaff($id)
    {
        $staff = Staff::find($id);

        $staff->is_active = false;
        $staff->terminated_at = Carbon::now();

        $staff->save();

        return response()->json([
            'staff'=>new StaffResource($staff),
            'message'=>'تم إلغاء حساب الموظف',
        ]);
    }
}
