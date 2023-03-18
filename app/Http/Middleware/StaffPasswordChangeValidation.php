<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class StaffPasswordChangeValidation
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
        $request->validate([
            'old_password'=>'required',
            'new_password'=>'required',
        ]);
        return $next($request);
    }
}
