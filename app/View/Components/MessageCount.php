<?php


namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Message;

class MessageCount extends Component
{
    public $projectId;
    public $userId;
    public $role;

    public function __construct($projectId, $userId, $role)
    {
        $this->projectId = $projectId;
        $this->userId = $userId;
        $this->role = $role;
    }

    public function render()
    {
        $messageCount = Message::where('project_id', $this->projectId)
            ->where('user_id', $this->userId)
            ->where('role', $this->role)
            ->where('is_read', 0)
            ->count();

        return view('components.message-count', compact('messageCount'));
    }
}
