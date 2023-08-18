<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPermissionAuthentication
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
            if(!Auth::user()->role->tests)
            {
                return response()->json(['message'=>'هذا المستخدم غير مسموح له بالدخول'],403);
            }
        }
        if(!Auth::user()->is_admin)
        {
            return response()->json(['message'=>'هذا المستخدم غير مسموح له بالدخول'],403);
        }
        
        return $next($request);
    }
}
