<?php

namespace App\View\Components\Admin;

use App\Models\DealAgent;
use App\Models\DealCategory;
use App\Models\DealStage;
use App\Models\Employee;
use App\Models\Lead;
use App\Models\LeadPipline;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AddDealForm extends Component
{

    public $employees;

    public $leads;

    public $piplines;

    public $stages;

    public $dealAgents;

    public $categories;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->employees = Employee::all();
        $this->leads = Lead::all();
        $this->piplines = LeadPipline::all();
        $this->stages = DealStage::all();
        $this->dealAgents = DealAgent::with('aggentEmployee')->get();
        $this->categories = DealCategory::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.add-deal-form');
    }
}
