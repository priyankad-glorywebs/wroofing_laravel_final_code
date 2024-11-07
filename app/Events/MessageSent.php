<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public string $name,
        public string $text,
        public string $role,
        public int $recipientId,
        public int $customer_id,
        public int $contractor_id,
        public string $project_id,
        public string $profile_image,
        public string $msg_date,
    ) {
        $userId = auth()->id();
        if ($userId != null) {
            $this->recipientId = $userId;
        }
        if ($userId == null) {
            $userId = auth()->guard('contractor')->user();
            $userId = $userId['id'];
            $this->recipientId = $userId;
        }
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('chats.' . $this->recipientId)
        ];
    }
}
