<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DraggableMenu extends Component
{
    /**
     * Create a new component instance.
     */
    public $sections;
    public $reportId;

    public function __construct($sections, $reportId)
    {
        $this->sections = $sections;
        $this->reportId = $reportId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.draggable-menu');
    }
}
