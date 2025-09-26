<?php

namespace App\Http\Middleware;

use App\Models\Employee;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsEmployeeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        $account = Employee::where('email', $user->email)->first();

        if ($account) {
            return $next($request);
        }

        return $next($request);
    }
}
