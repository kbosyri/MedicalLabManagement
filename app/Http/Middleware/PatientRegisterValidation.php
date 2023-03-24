<?php

namespace App\Http\Middleware;
use App\Models\Patient;
use Closure;
use Illuminate\Http\Request;

class PatientRegisterValidation
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

        if(Patient::where('username',$request->username)->where('is_active',true)->exists())
        {
            return response()->json(['message'=>'المستخدم مسجل في النظام'],400);
        }

        return $next($request);
    }
}
