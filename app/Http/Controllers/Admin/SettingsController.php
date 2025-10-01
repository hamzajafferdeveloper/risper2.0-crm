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

    public function leadSource()
    {
        return view('admin.settings.lead-source');
    }

    public function leadPipline()
    {
        return view('admin.settings.lead-pipline');
    }

    public function dealCategories()
    {
        return view('admin.settings.deal-category');
    }

    public function dealAgents(Request $request)
    {
        if ($request->ajax()) {
            $Agent = DealAgent::with('aggent', 'category')->get();

            return DataTables::of($Agent)
                ->addIndexColumn()
                ->rawColumns(['status', 'action'])
                ->make(true);

        }

        return view('admin.settings.deal-agent');
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
