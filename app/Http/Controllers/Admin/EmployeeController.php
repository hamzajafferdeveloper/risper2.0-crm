<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BusinessAddress;
use App\Models\Country;
use App\Models\Department;
use App\Models\Employee;
use App\Models\EmployeeDesignation;
use App\Models\EmploymentType;
use App\Models\Language;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Employee::with('reportingTo', 'department', 'designation');

            if ($request->reporting_to) {
                $query->where('reporting_to', $request->reporting_to);
            }

            if ($request->designation_id) {
                $query->where('designation_id', $request->designation_id);
            }

            if ($request->department_id) {
                $query->where('department_id', $request->department_id);
            }

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('reporting_to', function ($row) {
                    $user = $row->reportingTo;
                    if (! $user) {
                        return '-';
                    }

                    $image = $user->profile_pic
                        ? asset('storage/'.$user->profile_pic)
                        : asset('assets/images/avatar/avatar.png');

                    return '
                        <div class="flex items-center gap-2">
                            <img src="'.$image.'" alt="'.e($user->name).'" class="w-8 h-8 rounded-full object-cover border">
                            <span>'.e($user->name).'</span>
                        </div>
                    ';
                })
                ->addColumn('department_name', function ($row) {
                    return $row->department ? $row->department->name : '-';
                })
                ->addColumn('designation', function ($row) {
                    return $row->designation ? $row->designation->name : '-';
                })
                ->addColumn('action', function ($row) {
                    return '
                        <div class="flex gap-2">
                            <button class="btn btn-sm !bg-[#8D35E3] hover:!bg-[#8D35E3]/80 focus:!bg-[#8D35E3]/80 active:!bg-[#8D35E3]/80 dark:!bg-[#8D35E3]/80 dark:hover:!bg-[#8D35E3]/80 dark:focus:!bg-[#8D35E3]/80 dark:active:!bg-[#8D35E3]/80 text-white p-2 rounded editEmployee"
                                    data-id="'.$row->id.'" title="Edit">
                                <iconify-icon icon="mdi:pencil" class="text-lg"></iconify-icon>
                            </button>

                            <button data-id="'.$row->id.'" class="btn btn-sm !bg-red-500 hover:!bg-red-500/80 focus:!bg-red-500/80 active:!bg-red-500/80 dark:!bg-red-500/80 dark:hover:!bg-red-500/80 dark:focus:!bg-red-500/80 dark:active:!bg-red-500/80 text-white p-2 rounded deleteEmployee" title="Delete">
                                <iconify-icon icon="mage:trash" class="text-lg"></iconify-icon>
                            </button>
                        </div>
                    ';
                })
                ->rawColumns(['status', 'action', 'reporting_to']) // allow HTML
                ->make(true);
        }

        return view('admin.employees.index');
    }

    public function store(Request $request)
    {
        // Debug incoming data (optional)

        try {
            $validated = $request->validate([
                // 'employee_id' => 'required|string|max:50|unique:employees,employee_id',
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
                'login_allowed' => 'nullable',
                'receive_email_notification' => 'nullable',
                'slack_member_id' => 'nullable|string|max:255',

                // ✅ Changed from array to string
                'skills' => 'nullable|string',

                'probation_end_date' => 'nullable|date',
                'notice_period_start_date' => 'nullable|date',
                'notice_period_end_date' => 'nullable|date',
                'currency_id' => 'nullable|exists:currencies,id',
                'hourly_rate' => 'nullable|numeric|min:0',
                'employee_type_id' => 'nullable|exists:employment_types,id',
                'marital_status' => 'in:Single,Married,Widower,Widow,Separate,Divorced,Engaged',
                'business_address_id' => 'nullable|exists:business_addresses,id',
            ]);

            // ✅ Convert checkbox to "yes"/"no"
            $validated['login_allowed'] = $request->has('login_allowed') ? 'yes' : 'no';
            $validated['receive_email_notification'] = $request->has('receive_email_notification') ? 'yes' : 'no';

            // ✅ Hash password
            $validated['password'] = Hash::make($validated['password']);

            // ✅ Handle profile picture upload
            if ($request->hasFile('profile_pic')) {
                $file = $request->file('profile_pic');
                $uniqueName = Str::uuid()->toString().'.'.$file->getClientOriginalExtension();
                $validated['profile_pic'] = $file->storeAs('employees', $uniqueName, 'public');
            }

            // ✅ Convert skills string into array
            $validated['skills'] = $validated['skills'] = $request->filled('skills') ? explode(',', $request->input('skills')) : [];

            // ✅ Create employee
            $employee = Employee::create($validated);

            // ✅ Auto-generate employee_id (EMP-{id})
            $employee->employee_id = 'EMP-'.$employee->id;
            $employee->save();

            return response()->json([
                'message' => 'Employee created successfully.',
                'data' => $employee,
            ], 201);

        } catch (QueryException $e) {
            Log::error('Database error while creating employee: '.$e->getMessage());

            return response()->json(['error' => 'Database error occurred.'], 500);

        } catch (Exception $e) {
            Log::error('Error while creating employee: '.$e->getMessage());

            return response()->json(['error' => 'An unexpected error occurred.'], 500);
        }
    }

    public function show($id)
    {
        $employee = Employee::with('designation', 'department', 'reportingTo', 'country', 'language', 'currency', 'employmentType', 'businessAddress')->findOrFail($id);

        return view('admin.employees.show', compact('employee'));
    }

    public function edit($id)
    {

        try {
            $employee = Employee::findOrFail($id);

            return response()->json($employee);
        } catch (QueryException $e) {
            Log::error('Database error while editing employee: '.$e->getMessage());
        }
    }

    public function getEditDropdown()
    {
        try {

            $countries = Country::all();
            $languages = Language::all();
            $designations = EmployeeDesignation::all();
            $departments = Department::all();
            $employmentTypes = EmploymentType::all();
            $bussinessAddresses = BusinessAddress::all();
            $employees = Employee::all();

            return response()->json([
                'countries' => $countries,
                'languages' => $languages,
                'designations' => $designations,
                'departments' => $departments,
                'employmentTypes' => $employmentTypes,
                'bussinessAddresses' => $bussinessAddresses,
                'employees' => $employees,
            ], 200);
        } catch (Exception $e) {
            Log::error('Error while getting edit dropdown: '.$e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $employee = Employee::findOrFail($id);
            $validated = $request->validate([
                // 'employee_id' => 'required|string|max:50|unique:employees,employee_id,'.$employee->id,
                'salutation' => 'in:Mr,Mrs,Miss,Dr.,Sir,Madam',
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:employees,email,'.$employee->id,
                'profile_pic' => 'nullable|image|max:2048',
                'password' => 'nullable|string|min:8',
                'designation_id' => 'nullable|exists:employee_designations,id',
                'department_id' => 'nullable|exists:departments,id',
                'country_id' => 'nullable|exists:countries,id',
                'mobile' => 'nullable|string|max:20',
                'gender' => 'in:male,female,other',
                'joining_date' => 'required|date',
                'date_of_birth' => 'nullable|date',
                'reporting_to' => 'nullable|exists:employees,id|not_in:'.$employee->id,
                'language_id' => 'nullable|exists:languages,id',
                'address' => 'nullable|string|max:500',
                'about' => 'nullable|string',
                'login_allowed' => 'nullable',
                'receive_email_notification' => 'nullable',
                'slack_member_id' => 'nullable|string|max:255',
                'skills' => 'nullable|string',
                'probation_end_date' => 'nullable|date',
                'notice_period_start_date' => 'nullable|date',
                'notice_period_end_date' => 'nullable|date',
                'currency_id' => 'nullable|exists:currencies,id',
                'hourly_rate' => 'nullable|numeric|min:0',
                'employee_type_id' => 'nullable|exists:employment_types,id',
                'marital_status' => 'in:Single,Married,Widower,Widow,Separate,Divorced,Engaged',
                'business_address_id' => 'nullable|exists:business_addresses,id',
            ]);

            // Convert checkboxes to yes/no
            $validated['login_allowed'] = $request->has('login_allowed') ? 'yes' : 'no';
            $validated['receive_email_notification'] = $request->has('receive_email_notification') ? 'yes' : 'no';

            // Hash new password if provided
            if (! empty($validated['password'])) {
                $validated['password'] = Hash::make($validated['password']);
            } else {
                unset($validated['password']);
            }

            // Handle profile picture
            if ($request->hasFile('profile_pic')) {
                // Delete old picture if exists
                if ($employee->profile_pic && Storage::disk('public')->exists($employee->profile_pic)) {
                    Storage::disk('public')->delete($employee->profile_pic);
                }

                $file = $request->file('profile_pic');
                $uniqueName = Str::uuid()->toString().'.'.$file->getClientOriginalExtension();
                $validated['profile_pic'] = $file->storeAs('employees', $uniqueName, 'public');
            }

            // Convert skills string into array
            $validated['skills'] = $validated['skills'] = $request->filled('skills') ? explode(',', $request->input('skills')) : [];

            // Update employee
            $employee->update($validated);

            return response()->json([
                'message' => 'Employee updated successfully.',
                'data' => $employee,
            ], 200);

        } catch (QueryException $e) {
            Log::error('Database error while updating employee: '.$e->getMessage());

            return response()->json(['error' => 'Database error occurred.'], 500);

        } catch (Exception $e) {
            Log::error('Error while updating employee: '.$e->getMessage());

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
                'message' => 'Employee deleted successfully.',
            ], 200);

        } catch (QueryException $e) {
            Log::error('Database error while deleting employee: '.$e->getMessage());

            return response()->json(['error' => 'Database error occurred.'], 500);

        } catch (Exception $e) {
            Log::error('Error while deleting employee: '.$e->getMessage());

            return response()->json(['error' => 'An unexpected error occurred.'], 500);
        }
    }
}
