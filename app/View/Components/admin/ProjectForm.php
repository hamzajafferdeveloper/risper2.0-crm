<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProjectForm extends Component
{
    public $formId;
    /**
     * Create a new component instance.
     */
    public function __construct(?string $formId = null)
    {
        $this->formId = $formId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.project-form');
    }
}
