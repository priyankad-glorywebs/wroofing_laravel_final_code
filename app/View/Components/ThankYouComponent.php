<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ThankYouComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public $section;
    public function __construct($section)
    {
        // dd($section);
        $this->section = $section;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        // dd($this->section);
        return view('components.thank-you-component');
    }
}