<?php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;


class UnreadMessageCountCustomer implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $projectId;
    public $contractor_uid;
    public $messageCount;

    public function __construct($projectId, $contractor_uid, $messageCount)
    {
        $this->projectId = $projectId;
        $this->userId = $contractor_uid;
        $this->messageCount = $messageCount;
    }

    public function broadcastOn()
    {
        return new Channel('update-real-time-count-customer-side.' . $this->projectId);
    }

    public function broadcastWith()
    {
        return [
            'projectId' => $this->projectId,
            'contractor_uid' => $this->contractor_uid,
            'messageCount' => $this->messageCount,
        ];
    }
}
