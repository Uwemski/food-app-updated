<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //check if request is coming from user and user is admin
        if($request->user() && $request->user()->admin){
            return $next($request);//alow
        }
        //redirect to home
        return redirect('home');
    }
}
