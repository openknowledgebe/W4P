<?php

namespace W4P\Http\Middleware;

use Closure;

class CheckIfEnvironmentIsReady
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
        // TODO: Check if the project is configured (= environment ready).
        return $next($request);
    }
}
