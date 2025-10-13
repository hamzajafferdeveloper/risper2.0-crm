<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        // Try User first
        $account = User::where('email', $request->email)->first();

        // If not found in User, check Employee
        $isEmployee = false;
        if (! $account) {
            $account = Employee::where('email', $request->email)->first();
            $isEmployee = $account ? true : false;
        }

        if (! $account) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials',
            ], 401);
        }

        // Verify password
        if (!Hash::check($request->password, $account->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials',
            ], 401);
        }

        if ($isEmployee) {
            Auth::guard('employee')->login($account);

            return response()->json([
                'success' => true,
                'message' => 'Login successful',
            ], 200);

        } else {
            Auth::guard('web')->login($account);

            return response()->json([
                'success' => true,
                'message' => 'Login successful',
                'redirect' => route('admin.dashboard'),
            ], 200);
        }


    }
}
