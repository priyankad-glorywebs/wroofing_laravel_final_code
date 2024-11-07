<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class QuotationSection extends Component
{
    /**
     * Create a new component instance.
     */
    public $content;
    public $section;

     public function __construct($content, $section)
    {
        $this->content = $content;
        $this->section = $section;
    }
     /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
       return view('components.quotation-section');
    }
}
