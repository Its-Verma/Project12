<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::guard('admin')->user();

        if (!$user) {
            // Redirect if no user is authenticated
            return redirect()->route('admin.login');
        }

        // Check if the logged-in user is a superadmin
        $hasSuperadminPermission = DB::table('role_permission')
            ->join('permissions', 'role_permission.permission_id', '=', 'permissions.id')
            ->where('role_permission.role_id', $user->role_id)
            ->where('permissions.name', 'superadmin')
            ->exists();

        // Redirect regular admins trying to access superadmin routes
        if (!$hasSuperadminPermission && $request->is('admin/superadmin/*')) {
            return redirect()->route('other.dashboard');
        }

        return $next($request);
    }
}
