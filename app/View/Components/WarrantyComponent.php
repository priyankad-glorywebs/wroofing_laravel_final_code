<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class WarrantyComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public $section;
    public $sectionContents;
    public $customerDetails;
    public function __construct($section, $sectionContents, $customerDetails)
    {
        $this->section = $section;
        $this->sectionContents = $sectionContents;
        $this->customerDetails = $customerDetails;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.warranty-component');
    }
}
