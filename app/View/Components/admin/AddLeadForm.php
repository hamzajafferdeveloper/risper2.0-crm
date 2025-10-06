<?php

namespace App\View\Components\Admin;

use App\Models\Country;
use App\Models\DealAgent;
use App\Models\DealCategory;
use App\Models\DealStage;
use App\Models\Employee;
use App\Models\LeadPipline;
use App\Models\LeadSource;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AddLeadForm extends Component
{
    public $lead_sources;

    public $employees;

    public $piplines;

    public $stages;

    public $dealAgents;

    public $categories;

    public $products;

    public $countries;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->lead_sources = LeadSource::all();
        $this->employees = Employee::all();
        $this->piplines = LeadPipline::all();
        $this->stages = DealStage::all();
        $this->dealAgents = DealAgent::with('aggentEmployee')->get();
        $this->categories = DealCategory::all();
        $this->countries = Country::all();
        $this->products = [
            [
                'id' => 1,
                'name' => 'Mobile',
            ],
            [
                'id' => 2,
                'name' => 'Laptop',
            ],
            [
                'id' => 3,
                'name' => 'Desktop',
            ],
            [
                'id' => 4,
                'name' => 'Tablet',
            ],
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.add-lead-form');
    }
}
