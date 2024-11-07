<?php
namespace App\Repositories;

use App\Models\Project;
use App\Models\Message;
use App\Models\User; //Model 
use App\Models\Contractor; //Model

class ChatRepository
{
    /* create */
    public function createChat($messageData)
    {
        try {
            $message = Message::create([
                'user_id' => $messageData['user_id'],
                'text' => $messageData['text'],
                'project_id' => $messageData['project_id'],
                'role' => $messageData['role'],
                'contractor_id' => $messageData['contractor_id'],
            ]);

            if ($messageData['role'] == 'customer') {
                $user = User::where('id', $message['user_id'])->first();
            } elseif ($messageData['role'] == 'contractor') {
                $user = Contractor::where('id', $message['contractor_id'])->first();
            }

            $loginInfo = array(
                'user' => $user,
                'message' => $messageData['text'],
                'msg_date' => $message['created_at'],
            );
            return $loginInfo;
        } catch (\Exception $e) {
            throw $e;
        }
    }
}