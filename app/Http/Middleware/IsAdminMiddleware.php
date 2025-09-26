<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->guest()){
            return redirect()->route('login');
        } else {
            $user = $request->user();

            $account = User::where('email', $user->email)->first();

            if ($account) {
                return $next($request);
            }

            return $next($request);
        };
    }
}
