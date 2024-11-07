<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TermAndConditionSection extends Component
{
    /**
     * Create a new component instance.
     */
    public $section;
    public $content;
    public function __construct($content,$section)
    {
        $this->section = $section;
        $this->content = $content;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        // dd($thiss->content);
        return view('components.term-and-condition-section');
    }
}
