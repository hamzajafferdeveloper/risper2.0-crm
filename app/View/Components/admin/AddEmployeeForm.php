<?php

namespace App\View\Components\Admin;

use App\Models\BusinessAddress;
use App\Models\Country;
use App\Models\Department;
use App\Models\Employee;
use App\Models\EmployeeDesignation;
use App\Models\EmploymentType;
use App\Models\Language;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AddEmployeeForm extends Component
{

    public $designations;
    public $departments;
    public $countries;
    public $employees;
    public $languages;

    public $employment_types;

    public $business_addresses;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $designations = EmployeeDesignation::all();
        $departments = Department::all();
        $countries = Country::all();
        $employees = Employee::all();
        $languages = Language::all();
        $employment_types = EmploymentType::all();
        $business_addresses = BusinessAddress::all();

        $this->designations = $designations;
        $this->departments = $departments;
        $this->countries = $countries;
        $this->employees = $employees;
        $this->languages = $languages;
        $this->employment_types = $employment_types;
        $this->business_addresses = $business_addresses;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.add-employee-form');
    }
}
