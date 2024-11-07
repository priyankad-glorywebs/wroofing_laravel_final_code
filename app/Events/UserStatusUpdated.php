<?php
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\Channel;

class UserStatusUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userId;
    public $projectId;
    public $isOnline;

    public function __construct($userId, $projectId, $isOnline)
    {
        $this->userId = $userId;
        $this->projectId = $projectId;
        $this->isOnline = $isOnline;
    }

    public function broadcastOn()
    {
        return new Channel('status-update-project.' . $this->projectId);
    }

    public function broadcastWith()
    {
        return [
            'userId' => $this->userId,
            'projectId' => $this->projectId,
            'isOnline' => $this->isOnline,
        ];
    }
}
