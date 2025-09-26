<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    public function index()
    {
        return view("admin.employees.index");
    }

    public function add()
    {
        return view("admin.employees.add");
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'employee_id' => 'required|string|max:50|unique:employees,employee_id',
                'salutation' => 'in:Mr,Mrs,Miss,Dr.,Sir,Madam',
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:employees,email',
                'profile_pic' => 'nullable|image|max:2048',
                'password' => 'required|string|min:8',
                'designation_id' => 'nullable|exists:employee_designations,id',
                'department_id' => 'nullable|exists:departments,id',
                'country_id' => 'nullable|exists:countries,id',
                'mobile' => 'nullable|string|max:20',
                'gender' => 'in:male,female,other',
                'joining_date' => 'required|date',
                'date_of_birth' => 'nullable|date',
                'reporting_to' => 'nullable|exists:employees,id',
                'language_id' => 'nullable|exists:languages,id',
                'address' => 'nullable|string|max:500',
                'about' => 'nullable|string',
                'login_allowed' => 'in:yes,no',
                'receive_email_notification' => 'in:yes,no',
                'slack_member_id' => 'nullable|string|max:255',
                'skills' => 'nullable|array',
                'probation_end_date' => 'nullable|date',
                'notice_period_start_date' => 'nullable|date',
                'notice_period_end_date' => 'nullable|date',
                'currency_id' => 'nullable|exists:currencies,id',
                'hourly_date' => 'nullable|numeric|min:0',
                'employee_type_id' => 'nullable|exists:employment_types,id',
                'marital_status' => 'in:Single,Married,Widower,Widow,Separate,Divorced,Engaged',
                'business_address_id' => 'nullable|exists:business_addresses,id',
            ]);

            // Hash password
            $validated['password'] = Hash::make($validated['password']);

            // Handle profile picture upload
            if ($request->hasFile('profile_pic')) {
                $file = $request->file('profile_pic');
                $uniqueName = Str::uuid()->toString() . '.' . $file->getClientOriginalExtension();
                $validated['profile_pic'] = $file->storeAs('employees', $uniqueName, 'public');
            }

            $employee = Employee::create($validated);

            return response()->json([
                'message' => 'Employee created successfully.',
                'data' => $employee,
            ], 201);

        } catch (QueryException $e) {
            Log::error('Database error while creating employee: ' . $e->getMessage());
            return response()->json(['error' => 'Database error occurred.'], 500);

        } catch (Exception $e) {
            Log::error('Error while creating employee: ' . $e->getMessage());
            return response()->json(['error' => 'An unexpected error occurred.'], 500);
        }
    }

    public function show($id)
    {
        // return view("");
    }

    public function edit($id)
    {
        // return view("");
    }

    public function update(Request $request, $id)
    {
        try {
            $employee = Employee::findOrFail($id);

            $validated = $request->validate([
                'employee_id' => 'required|string|max:50|unique:employees,employee_id,' . $employee->id,
                'salutation' => 'in:Mr,Mrs,Miss,Dr.,Sir,Madam',
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:employees,email,' . $employee->id,
                'profile_pic' => 'nullable|image|max:2048',
                'password' => 'nullable|string|min:8',
                'designation_id' => 'nullable|exists:employee_designations,id',
                'department_id' => 'nullable|exists:departments,id',
                'country_id' => 'nullable|exists:countries,id',
                'mobile' => 'nullable|string|max:20',
                'gender' => 'in:male,female,other',
                'joining_date' => 'required|date',
                'date_of_birth' => 'nullable|date',
                'reporting_to' => 'nullable|exists:employees,id|not_in:' . $employee->id,
                'language_id' => 'nullable|exists:languages,id',
                'address' => 'nullable|string|max:500',
                'about' => 'nullable|string',
                'login_allowed' => 'in:yes,no',
                'receive_email_notification' => 'in:yes,no',
                'slack_member_id' => 'nullable|string|max:255',
                'skills' => 'nullable|array',
                'probation_end_date' => 'nullable|date',
                'notice_period_start_date' => 'nullable|date',
                'notice_period_end_date' => 'nullable|date',
                'currency_id' => 'nullable|exists:currencies,id',
                'hourly_date' => 'nullable|numeric|min:0',
                'employee_type_id' => 'nullable|exists:employment_types,id',
                'marital_status' => 'in:Single,Married,Widower,Widow,Separate,Divorced,Engaged',
                'business_address_id' => 'nullable|exists:business_addresses,id',
            ]);

            // Hash new password if provided
            if (!empty($validated['password'])) {
                $validated['password'] = Hash::make($validated['password']);
            } else {
                unset($validated['password']);
            }

            // Handle profile picture update
            if ($request->hasFile('profile_pic')) {
                // Delete old file if it exists
                if ($employee->profile_pic && Storage::disk('public')->exists($employee->profile_pic)) {
                    Storage::disk('public')->delete($employee->profile_pic);
                }

                // Save new file with unique name
                $file = $request->file('profile_pic');
                $uniqueName = Str::uuid()->toString() . '.' . $file->getClientOriginalExtension();
                $validated['profile_pic'] = $file->storeAs('employees', $uniqueName, 'public');
            }

            $employee->update($validated);

            return response()->json([
                'message' => 'Employee updated successfully.',
                'data' => $employee,
            ], 200);

        } catch (QueryException $e) {
            Log::error('Database error while updating employee: ' . $e->getMessage());
            return response()->json(['error' => 'Database error occurred.'], 500);

        } catch (Exception $e) {
            Log::error('Error while updating employee: ' . $e->getMessage());
            return response()->json(['error' => 'An unexpected error occurred.'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $employee = Employee::findOrFail($id);

            // Delete profile picture if exists
            if ($employee->profile_pic && Storage::disk('public')->exists($employee->profile_pic)) {
                Storage::disk('public')->delete($employee->profile_pic);
            }

            $employee->delete();

            return response()->json([
                'message' => 'Employee deleted successfully.'
            ], 200);

        } catch (QueryException $e) {
            Log::error('Database error while deleting employee: ' . $e->getMessage());
            return response()->json(['error' => 'Database error occurred.'], 500);

        } catch (Exception $e) {
            Log::error('Error while deleting employee: ' . $e->getMessage());
            return response()->json(['error' => 'An unexpected error occurred.'], 500);
        }
    }

}
