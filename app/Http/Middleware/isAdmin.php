<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //! 001 => Check if user sign-in in site and is admin 
         //^ 1.1 => Case is not admin
            if (Auth::check() && !Auth::user()->isAdmin) {
                return redirect()->route('site.home')->with('error', 'أنت غير مسرح لك بدخول هذا المسار🤷‍♂️');
            }
        
         //^ 1.2 => Case Admin
            return $next($request);
    }
}
