<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Carbon\Carbon;
use App\Models\Project;

class ContractorProjectList extends Component
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

        $currentMonth = Carbon::now()->month;
        $projects = Project::whereMonth('projects.created_at', $currentMonth)
            ->orderBy('projects.id', 'DESC')
            ->paginate(3);
        return view('components.contractor-project-list',compact('projects'));
    }
}
