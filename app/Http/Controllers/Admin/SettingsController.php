<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

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

    public function languages()
    {
        return view('admin.settings.languages');
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

    public function leads()
    {
        return view('admin.settings.leads');
    }
}
