<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}
