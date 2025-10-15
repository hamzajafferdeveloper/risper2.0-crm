<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BusinessAddress;
use App\Models\Country;
use App\Models\DealCategory;
use App\Models\Department;
use App\Models\Employee;
use App\Models\EmployeeDesignation;
use App\Models\EmploymentType;
use Yajra\DataTables\DataTables;

class SettingsController extends Controller
{
    public function index()
    {

        return view('admin.settings.company-setting');
    }

    public function businessAddress()
    {
        if (request()->ajax()) {
            $departments = BusinessAddress::with('country');

            return DataTables::of($departments)
                ->addIndexColumn()
                 ->addColumn('country_name', fn ($row) => $row->country?->name ?? '-')
                ->make(true);
        }

        $countries = Country::all();

        return view('admin.settings.business-address', compact('countries'));
    }

    public function employeesDesignation()
    {
        if (request()->ajax()) {
            $departments = EmployeeDesignation::with('parentDesignation');

            return DataTables::of($departments)
                ->addIndexColumn()
                ->addColumn('parent_name', fn ($row) => $row->parentDesignation?->name ?? '-')
                ->make(true);
        }

        return view('admin.settings.employee-designation');
    }

    public function employmentTypes()
    {
        if (request()->ajax()) {
            $departments = EmploymentType::get();

            return DataTables::of($departments)
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.settings.employment-types');
    }

    public function departments()
    {
        if (request()->ajax()) {
            $departments = Department::with('parentDepartment');

            return DataTables::of($departments)
                ->addIndexColumn()
                ->addColumn('parent_name', fn ($row) => $row->parentDepartment?->name ?? '-')
                ->make(true);
        }

        return view('admin.settings.departments');
    }

    public function leads()
    {
        return view('admin.settings.lead');
    }

    public function leadPipline()
    {
        return view('admin.settings.lead-pipline');
    }

    public function employees()
    {
        $employee = Employee::all();
        $categories = DealCategory::all();

        return response()->json([
            'employees' => $employee,
            'categories' => $categories,
        ], 200);
    }
}
