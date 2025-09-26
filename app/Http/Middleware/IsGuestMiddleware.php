<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsGuestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->guest()) {
            return $next($request);
        }

        $user = auth()->user();

        if (User::where('email', $user->email)->first()){

            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('employee.dashboard');

    }
}
