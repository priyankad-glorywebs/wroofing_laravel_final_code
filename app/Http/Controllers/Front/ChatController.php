<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use App\Repositories\ChatRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Message;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use App\Models\Contractor;
use Carbon\Carbon;
use App\Events\UnreadMessageCountUpdated;
use App\Events\UnreadMessageCountCustomer;

// use App\Models\OnlineUserStatus;

class ChatController extends Controller
{
    //
    private $chatRepository;

    public function __construct(ChatRepository $chatRepository)
    {
        $this->chatRepository = $chatRepository;
    }

    /* contractor side */
    public function IndexContractor($project_id, $contractor_id)
    {
        try {
            if (isset($project_id) && $contractor_id) {
                $cid = base64_decode($contractor_id);
                $pid = base64_decode($project_id);
                if (Auth::user()) {
                    $userId = \Auth::user();
                } else {
                    $userId = auth()->guard('contractor')->user();
                }

                $message_data = DB::table('messages')
                    ->where('messages.user_id', $userId->id)
                    ->where('messages.contractor_id', $cid)
                    ->where('messages.project_id', $pid)
                    ->leftJoin('users as u', 'messages.user_id', '=', 'u.id')
                    ->leftJoin('contractors as c', 'messages.contractor_id', '=', 'c.id')
                    ->select('messages.*', 'u.name as name', 'u.email as email', 'u.profile_image as u_profile_image', 'c.name as contractor_name', 'c.email as contractor_email', 'c.profile_image as c_profile_image')
                    ->orderBy('messages.created_at', 'desc')
                    ->limit(5)
                    ->get();

                $projectInfo = Project::findOrFail($pid);

                $contractor_data = Contractor::where('id', $cid)->first();

                return view('layouts.front.chat-contractor', compact('projectInfo', 'pid', 'message_data', 'contractor_data'));
            }
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "message" => "Something went wrong",
                "error" => $e->getMessage(),
            ]);
        }
    }

    public function contractorloadMoreMessages(Request $request)
    {
        $cid = $request->input('contractor_id');
        $pid = $request->input('project_id');
        if (Auth::user()) {
            $userId = \Auth::user();
        } else {
            $userId = auth()->guard('contractor')->user();
        }
        $page = $request->input('page');
        $message_data = DB::table('messages')
            ->where('messages.user_id', $userId->id)
            ->where('messages.contractor_id', $cid)
            ->where('messages.project_id', $pid)
            ->leftJoin('users as u', 'messages.user_id', '=', 'u.id')
            ->leftJoin('contractors as c', 'messages.contractor_id', '=', 'c.id')
            ->select('messages.*', 'u.name as name', 'u.email as email', 'u.profile_image as u_profile_image', 'c.name as contractor_name', 'c.email as contractor_email', 'c.profile_image as c_profile_image')
            ->orderBy('messages.created_at', 'desc')
            ->paginate(5, ['*'], 'page', $page);

        return view('layouts.front.chat-contractor-loadmsg', compact('message_data'));
    }

    /* customer side */
    public function IndexCustomer($project_id, $customer_id)
    {
        try {
            if (isset($project_id) && $customer_id) {
                $cid = base64_decode($customer_id);
                $pid = base64_decode($project_id);
                if (Auth::user()) {
                    $userId = \Auth::user();
                } else {
                    $userId = auth()->guard('contractor')->user();
                }

                $message_data = DB::table('messages')
                    ->where('messages.user_id', $cid)
                    ->where('messages.contractor_id', $userId->id)
                    ->where('messages.project_id', $pid)
                    ->leftJoin('users as u', 'messages.user_id', '=', 'u.id')
                    ->leftJoin('contractors as c', 'messages.contractor_id', '=', 'c.id')
                    ->select('messages.*', 'u.name as name', 'u.email as email', 'u.profile_image as u_profile_image', 'c.name as contractor_name', 'c.email as contractor_email', 'c.profile_image as c_profile_image')
                    ->orderBy('messages.created_at', 'desc')
                    ->limit(5)
                    ->get();

                $projectInfo = Project::findOrFail($pid);
                $customer_data = User::where('id', $cid)->first();
                return view('layouts.front.chat-customer', compact('projectInfo', 'pid', 'message_data', 'customer_data'));
            }
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "message" => "Something went wrong",
                "error" => $e->getMessage(),
            ]);
        }
    }

    public function customerloadMoreMessages(Request $request)
    {
        $cid = $request->input('customer_id');
        $pid = $request->input('project_id');
        if (Auth::user()) {
            $userId = \Auth::user();
        } else {
            $userId = auth()->guard('contractor')->user();
        }
        $page = $request->input('page');
        $message_data = DB::table('messages')
            ->where('messages.user_id', $cid)
            ->where('messages.contractor_id', $userId->id)
            ->where('messages.project_id', $pid)
            ->leftJoin('users as u', 'messages.user_id', '=', 'u.id')
            ->leftJoin('contractors as c', 'messages.contractor_id', '=', 'c.id')
            ->select('messages.*', 'u.name as name', 'u.email as email', 'u.profile_image as u_profile_image', 'c.name as contractor_name', 'c.email as contractor_email', 'c.profile_image as c_profile_image')
            ->orderBy('messages.created_at', 'desc')
            ->paginate(5, ['*'], 'page', $page);

        return view('layouts.front.chat-customer-loadmsg', compact('message_data'));
    }
    public function addMessage(Request $request): JsonResponse
    {
        $userInfo = \Auth::user();
        $profile_image = null;
        if (isset($userInfo->profile_image)) {
            $profile_image = $userInfo->profile_image;
        } else {
            $profile_image = 'frontend-assets/images/defaultimage.jpg';
        }


        $userId = auth()->id();
        $role = 'customer';
        if ($userId == null) {
            $userId = auth()->guard('contractor')->user();
            $profile_image = $userId['profile_image'];
            if ($profile_image == null) {
                $profile_image = 'frontend-assets/images/defaultimage.jpg';
            }
            $userId = $userId['id'];
            $role = 'contractor';
        }

        $messageData = [
            'user_id' => $request->get('customer_id'),
            'text' => $request->get('message'),
            'project_id' => $request->get('project_id'),
            'role' => $role,
            'contractor_id' => $request->get('contractor_id'),
        ];

        $messageRes = $this->chatRepository->createChat($messageData);

        // Assuming $message is the model instance representing your message
        $date = $messageRes['msg_date'];
        // Format the date using Carbon
        $currentTimeLocal = $date->setTimezone('Asia/Kolkata');
        // $currentTimeLocal = $date->setTimezone('America/New_York');
        $msg_date = Carbon::parse($currentTimeLocal)->format('g:ia');
        MessageSent::dispatch($messageRes['user']['name'], $messageRes['message'], $role, $userId, $request->get('customer_id'), $request->get('contractor_id'), (int) $request->get('project_id'), $profile_image, $msg_date);
        return response()->json(['error' => false, 'message' => 'Message sent!']);
    }

    public function updateStatus(Request $request)
    {
        $userId     = $request->input('userId');
        $projectId  = $request->input('projectId');
        $isOnline   = $request->input('isOnline');
        $role       = $request->input('role');

        if ($isOnline == true) {
		    $data = Message::where('user_id', (int)$userId)
            ->where('project_id', (int)$projectId)
            ->where('is_read', 0)
            ->where('role', $role)
            ->get();
					
            foreach ($data as $message) {
                $message->is_read = 1;
                $message->save();
            }
            return response()->json(['status' => 'success']);
        }


        
    }


    public function updateMessageCount(Request $request)
    {
        $projectId = $request->input('projectId');
        $userId = $request->input('userId');
        $role = $request->input('role');

        $messageCount = Message::where('project_id', $projectId)
            ->where('user_id', $userId)
            ->where('role', 'customer')
            ->where('is_read', 0)
            ->count();

            UnreadMessageCountUpdated::dispatch($projectId,$userId,$messageCount);


        return response()->json(['messageCount' => $messageCount]);
    }


    public function getMessageCount(Request $request)
    {   
    $projectId = $request->input('projectId');
    $userId = $request->input('userId');
    $role = $request->input('role');

    $messageCount = Message::where('project_id', $projectId)
        ->where('user_id', $userId)
        ->where('role','customer')
        ->where('is_read', 0)
        ->count();

    UnreadMessageCountUpdated::dispatch($projectId,$userId,$messageCount);
    return response()->json(['messageCount' => $messageCount]);
}

public function getCustomerMessageCount(Request $request){
    $contractor_pid = $request->input('contractor_pid');
    $contractor_uid = $request->input('contractor_uid');
    $role = $request->input('role');
    // dd($contractor_pid);
    // $messageCount = Message::where('project_id', $contractor_pid)
    //     ->where('role', 'contractor')
    //     ->where('user_id', \Auth::user()->id)
    //     ->where('is_read', 0)
    //     ->where('contractor_id', $contractor_uid)
    //     ->count();

    $messageCount = Message::
    where('project_id', $contractor_pid)
    ->where('contractor_id', $contractor_uid)
    ->where('is_read',0)
    ->where('role', 'contractor')
    ->get()
    ->count();

        // dd($messageCount);
    UnreadMessageCountCustomer::dispatch($contractor_pid, $contractor_uid, $messageCount);
    return response()->json(['messageCount' => $messageCount]);
}

}
