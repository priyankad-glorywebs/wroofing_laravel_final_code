<?php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;


class UnreadMessageCountUpdated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $projectId;
    public $userId;
    public $messageCount;

    public function __construct($projectId, $userId, $messageCount)
    {
        $this->projectId = $projectId;
        $this->userId = $userId;
        $this->messageCount = $messageCount;
    }

    public function broadcastOn()
    {
        return new Channel('update-real-time-count-contractor-side.' . $this->projectId);
    }

    public function broadcastWith()
    {
        return [
            'projectId' => $this->projectId,
            'userId' => $this->userId,
            'messageCount' => $this->messageCount,
        ];
    }
}
