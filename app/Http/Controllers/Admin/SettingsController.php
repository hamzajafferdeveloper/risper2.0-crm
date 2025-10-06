<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DealAgent;
use App\Models\DealCategory;
use App\Models\Employee;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SettingsController extends Controller
{
    public function index()
    {
        return view('admin.settings.company-setting');
    }

    public function businessAddress()
    {
        return view('admin.settings.business-address');
    }

    public function employeesDesignation()
    {
        return view('admin.settings.employee-designation');
    }

    public function employmentTypes()
    {
        return view('admin.settings.employment-types');
    }

    public function departments()
    {
        return view('admin.settings.departments');
    }

    public function leads(){
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
