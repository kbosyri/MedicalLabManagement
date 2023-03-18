<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class StaffUpdateValidation
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
            'first_name'=>'required',
            'father_name'=>'required',
            'last_name'=>'required',
            'username'=>'required',
            'qualifications'=>'required',
            'email'=>'email',

        ]);

        return $next($request);
    }
}
