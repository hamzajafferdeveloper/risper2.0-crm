<?php

namespace App\View\Components\Admin;

use App\Models\DealAgent;
use App\Models\Employee;
use App\Models\LeadPipline;
use App\Models\LeadSource;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AddLeadModal extends Component
{

    public $lead_sources;
    public $employees;

    public $piplines;

    public $stages;
    public $dealAgents;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->lead_sources = LeadSource::all();
        $this->employees = Employee::all();
        $this->piplines = LeadPipline::all();
        $this->dealAgents = DealAgent::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.add-lead-modal');
    }
}
