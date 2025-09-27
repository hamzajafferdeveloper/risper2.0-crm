<?php

namespace App\View\Components\Admin;

use App\Models\Employee;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EditEmployeeForm extends Component
{
    public $employee;
    /**
     * Create a new component instance.
     */
    public function __construct($employeeId = null)
    {
        // dd($employeeId);
        $this->employee = $employeeId ? Employee::find($employeeId) : null;

        // dd($this->employee);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.edit-employee-form');
    }
}
