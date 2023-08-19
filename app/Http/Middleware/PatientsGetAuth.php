<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientsGetAuth
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
        if(Auth::user()->role)
        {
            if(!Auth::user()->role->patient_tests)
            {
                return response()->json(['message'=>'هذا المستخدم غير مسموح له بالدخول'],403);
            }
        }
        else if(!Auth::user()->is_admin && !Auth::user()->is_reception)
        {
            return response()->json(['message'=>'هذا المستخدم غير مسموح له بالدخول'],403);
        }
        return $next($request);
    }
}