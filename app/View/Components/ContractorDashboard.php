<?php
namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ContractorDashboard extends Component
{
    /**
     * Public properties for the component.
     */
    public $projectImage;
    // public $status;
    public $project;
    public $userinfo;
    public $messageCount;
    public $status;

    /**
     * Create a new component instance.
     *
     * @param $projectImage
     * 
     * @param $project
     * @param $userinfo
     * @param $messageCount
     * @param $status
     */
    public function __construct($projectImage, $project, $userinfo, $messageCount,$status)
    {
        // Assigning parameters to class properties
        $this->projectImage = $projectImage;
        // $this->status = $status;
        $this->project = $project;
        $this->userinfo = $userinfo;
        $this->messageCount = $messageCount;
        $this->status = $status;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.contractor-dashboard', [
            'projectImage' => $this->projectImage,
            // 'status' => $this->status,
            'project' => $this->project,
            'userinfo' => $this->userinfo,
            'messageCount' => $this->messageCount,
            'status'=>$this->status
        ]);
    }
}
