<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class ProjectList extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $projects = Project::orderBy("id", "desc")
        ->where('user_id',Auth::user()->id)
        // ->where('status',1)
        ->get();  
        return view('components.project-list',compact('projects'));
    }
}
