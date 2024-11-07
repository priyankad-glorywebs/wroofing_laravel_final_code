<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class IntroductionSection extends Component
{
    /**
     * Create a new component instance.
     */

     public $content;
     public $section;
     public $tokens;
    public function __construct($content = null, $section = null, $tokens = [])
    {
        $this->content = $content;
        $this->section = $section;
        $this->tokens = $tokens;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        // dd($this->section);
        return view('components.introduction-section');
    }
}
