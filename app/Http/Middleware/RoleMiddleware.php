<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Please login to access this page');
        }

        $user = Auth::user();

        // Check if user is frozen
        if ($user->is_frozen) {
            Auth::logout();
            return redirect('/login')->with('error', 'Your account has been frozen. Please contact administrator.');
        }

        $userRole = $user->role;

        // Define role hierarchies and permissions
        $rolePermissions = [
            'user' => ['user'],
            'manager' => ['user', 'manager'],
            'admin' => ['user', 'manager', 'admin'],
        ];

        // Check for specific role requirements
        switch ($role) {
            case 'admin':
                if ($userRole !== 'admin') {
                    return redirect('/')->with('error', 'Unauthorized Access - Admin privileges required');
                }
                break;

            case 'manager':
                if (!in_array($userRole, ['manager', 'admin'])) {
                    return redirect('/')->with('error', 'Unauthorized Access - Manager privileges required');
                }
                break;

            case 'admin_access':
                if (!in_array($userRole, ['admin', 'manager'])) {
                    return redirect('/')->with('error', 'Unauthorized Access - Admin or Manager privileges required');
                }
                break;

            case 'user':
                if (!in_array($userRole, ['user', 'manager', 'admin'])) {
                    return redirect('/')->with('error', 'Unauthorized Access - User privileges required');
                }
                break;

            default:
                // For any other role, check if user has that exact role
                if ($userRole !== $role) {
                    return redirect('/')->with('error', "Unauthorized Access - {$role} privileges required");
                }
                break;
        }

        return $next($request);
    }
}
