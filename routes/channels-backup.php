<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;
use App\Models\Message;
use App\Models\Project;

// Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });

// Define channel route for the 'web' guard
Broadcast::channel('chats.{userId}', function ($user, $userId, $guard) {
    // Check if the user is authenticated with the specified guard
    if (auth()->guard($guard)->check() && request()->user()) {
        // Ensure the user accessing the channel matches the requested userId
        return (int) $user->id === (int) $userId;
    }
});
Broadcast::channel('chats.{userId}', function ($user, $userId) {
    return true; // You can still specify the guard dynamically, or set it to a default value
}, ['guards' => ['web','contractor']]);



Broadcast::channel('status-update', function ($user) {
    $contractorUser = Auth::guard('contractor')->user();
    $webUser = Auth::guard('web')->user();
    $mergedUsers = [];
    if ($contractorUser) {
        $contractorUserArray = $contractorUser->toArray();
        $contractorUserArray['role'] = 'contractor';
        $mergedUsers[] = $contractorUserArray;
    }
    if($webUser) {
        $webUserArray = $webUser->toArray();
        $webUserArray['role'] = 'web';
        $mergedUsers[] = $webUserArray;
    }


    return !empty($mergedUsers) ? $mergedUsers : null;
}, ['guards' => ['web', 'contractor']]);


//contractor is online & customer is online in specified project auto read messages if recever is online
Broadcast::channel('status-update-project.{projectId}', function ($user, $projectId) {
    return !empty($user) ? $user : null;
}, ['guards' => ['web', 'contractor']]);

//update real time count of project
Broadcast::channel('update-real-time-count-contractor-side.{projectId}', function ($projectId) {
    return true; 
});
