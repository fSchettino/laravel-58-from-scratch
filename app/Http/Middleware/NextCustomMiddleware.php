<?php

namespace App\Http\Middleware;

use Closure;

class NextCustomMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(now()->format('s') % 2)
        {
            // If condition is verified next middleware registered in the HTTP kernel is called
            return $next($request);
        }

        // Otherwise return a message
        return response('Custom middleware says: Access not allowed');
    }
}
