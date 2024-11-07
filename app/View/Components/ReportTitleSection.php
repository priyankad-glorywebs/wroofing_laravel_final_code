<?php

namespace App\View\Components;

use App\Models\ReportSection;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ReportTitleSection extends Component
{
    /**
     * Create a new component instance.
     */

     public $section;
     public $content;
    public function __construct($section, $content)
    {
        $this->section = $section;
        $this->content = $content;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.report-title-section');
    }
}
