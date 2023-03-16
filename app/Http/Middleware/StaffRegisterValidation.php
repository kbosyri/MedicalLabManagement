<?php

namespace App\Http\Middleware;

use App\Models\Staff;
use Closure;
use Illuminate\Http\Request;

class StaffRegisterValidation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if(Staff::where('username',$request->username)->where('is_active',true)->exists())
        {
            return response()->json(['message'=>'المستخدم مسجل في النظام'],400);
        }

        if($request->is_lab_staff == null)
        {
            $request->validate([
                'is_reception'=>'required'
            ]);
        }
        else
        {
            $request->validate([
                'is_lab_staff'=>'required'
            ]);
        }
        return $next($request);
    }
}
