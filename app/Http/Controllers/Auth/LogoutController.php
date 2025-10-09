<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        // Check which guard is currently logged in
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        } elseif (Auth::guard('employee')->check()) {
            Auth::guard('employee')->logout();
        }

        // Invalidate the session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // If it's an AJAX request, return JSON
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Logout successful',
                'redirect' => route('login'),
            ], 200);
        }

        // Otherwise, redirect normally
        return redirect()->route('login')->with('success', 'You have been logged out successfully.');
    }
}
