<?php

namespace App\Http\Controllers;

use App\Http\Resources\Role\RoleResource;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function AddRole(Request $request)
    {
        $role = new Role();

        $role->name = $request->name;
        $role->tests = $request->tests;
        $role->patient_tests = $request->patient_tests;
        $role->auditing = $request->auditing;
        $role->reports = $request->reports;
        $role->job_applications = $request->job_applications;
        $role->announcements = $request->announcements;
        $role->finance = $request->finance;
        $role->human_resources = $request->human_resources;

        $role->save();

        return response()->json([
            'message'=>'تم إضافة الدور بنجاح',
            'role'=>new RoleResource($role)
        ]);
    }

    public function UpdateRole(Request $request, $id)
    {
        $role = Role::find($id);

        $role->name = $request->name;
        $role->tests = $request->tests;
        $role->patient_tests = $request->patient_tests;
        $role->auditing = $request->auditing;
        $role->reports = $request->reports;
        $role->job_applications = $request->job_applications;
        $role->announcements = $request->announcements;
        $role->finance = $request->finance;
        $role->human_resources = $request->human_resources;

        $role->save();

        return response()->json([
            'message'=>'تم نعديل الدور بنجاح',
            'role'=>new RoleResource($role)
        ]);
    }

    public function GetRoles()
    {
        $roles = Role::all();

        return RoleResource::collection($roles);
    }

    public function GetRole($id)
    {
        $role = Role::find($id);

        return new RoleResource($role);
    }
}
