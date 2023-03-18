<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class StaffValidationErrorHandler
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
        $response = null;
        try{
            $response = $next($request);
        }
        catch(Exception $e)
        {
            return response()->json(['message'=>'خطأ في الدخل إلى النظام'],400);
        }
        return $response;
    }
}
