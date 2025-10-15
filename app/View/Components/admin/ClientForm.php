<?php

namespace App\View\Components\Admin;

use App\Models\ClientCategory;
use App\Models\Country;
use App\Models\Employee;
use App\Models\Language;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ClientForm extends Component
{
    public $employees;
    public $countries;

    public $formId;

    public $languages;

    public $categories;

    public $sub_categories;

    /**
     * Create a new component instance.
     */
    public function __construct(?string $formId = null)
    {
        $this->countries = Country::all();
        $this->formId = $formId;
        $this->languages = Language::all();
        $this->categories = ClientCategory::where('parent_id', null)->get();
        $this->sub_categories = ClientCategory::where('parent_id', '!=', null)->get();
        $this->employees = Employee::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.client-form');
    }
}
