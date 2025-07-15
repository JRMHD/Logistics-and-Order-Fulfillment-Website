<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class UserActivity
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
        if (Auth::check()) {
            $user = Auth::user();

            // Check if user is frozen
            if ($user->is_frozen) {
                Auth::logout();
                return redirect('/login')->with('error', 'Your account has been frozen. Please contact administrator.');
            }

            // Set user as online
            Cache::put('user-is-online-' . $user->id, true, now()->addMinutes(5));

            // Update last seen using DB query
            DB::table('users')->where('id', $user->id)->update(['last_seen' => now()]);
        }

        return $next($request);
    }
}
