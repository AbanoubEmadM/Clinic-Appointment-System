<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user()) {
            return response()->json([
                'message' => 'Unauthenticated.',
            ], 401);
        }
        if (!in_array($request->user()->role, ['admin', 'doctor', 'patient', 'receptionist'])) {
            return response()->json([
                'message' => 'Unauthorized. You do not have access to this resource.',
            ], 403);
        }
        if (!$request->user()->is_active) {
            return response()->json([
                'message' => 'Your account has been deactivated. Please contact the admin.',
            ], 403);
        }
        return $next($request);
    }
}
