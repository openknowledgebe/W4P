<?php

namespace W4P\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use W4P\Models\Setting;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {

        $token = $request->session()->get('token');
        // Make sure the token in session matches the token in db
        if ($token == null || $token != Setting::get('token')) {
            // If the token is null (empty) or incorrect, redirect to login
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->route('admin::login');
            }
        }
        return $next($request);
    }
}
