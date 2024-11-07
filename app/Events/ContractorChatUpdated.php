<?php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ContractorChatUpdated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userId;
    public $projectId;
    public $message;
    public $role;
    public $customerId;
    public $isOnline;
    public $senderId;

    public function __construct($userId, $projectId, $senderId, $isOnline, $role, $customerId)
    {
        $this->userId = $userId;
        $this->projectId = $projectId;
        $this->isOnline = $isOnline;
        $this->senderId = $senderId;
        $this->role = $role;
        $this->customerId = $customerId;
    }

    public function broadcastOn()
    {
        return new PresenceChannel('contractor-chat-update.' . $this->projectId);
    }

    public function broadcastWith()
    {
        return [
            'userId' => $this->userId,
            'projectId' => $this->projectId,
            'isOnline' => $this->isOnline,
            'senderId' => $this->senderId,
            'role' => $this->role,
            'customerId' => $this->customerId,
        ];
    }
}

