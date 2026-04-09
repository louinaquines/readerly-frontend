<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RequireApiAuth
{
    public function handle(Request $request, Closure $next, string $role = null)
    {
        if (!session('api_token')) {
            return redirect()->route('login');
        }

        if ($role && session('role') !== $role) {
            abort(403, 'Unauthorized');
        }

        $response = $next($request);

        if (method_exists($response, 'getStatusCode') && $response->getStatusCode() === 401) {
            session()->flush();
            return redirect()->route('login')->withErrors(['email' => 'Session expired. Please login again.']);
        }

        return $response;
    }
}