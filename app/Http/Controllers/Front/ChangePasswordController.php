<?php

namespace App\Http\Controllers\Front;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Contractor;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function index(){
       return view('layouts.front.changepassword');
    }

    public function changePassword(Request $request)
    {   
        $validatedData = $request->validate([
            'cpassword' => 'required',
            'mpassword' => 'required',
            'cfmpassword' => 'required',
        ]);
        
        try {
            /* get login user guard and id for update */
            $userId     = Auth::id();
            $userGard   = null;
            if($userId != null){
                $userId = Auth::id();
                $userGard = Auth::guard();
                if(!empty($userGard)){
                    $userGard =  $userGard->name;
                }
            }
            if($userId == null){
                $userId = auth()->guard('contractor')->user();
                $userId = $userId['id'];
                $userGard = 'contractor';
            }
            
            if(!empty($request->cpassword) && !empty($request->mpassword) && !empty($request->cfmpassword)){
                if($request->mpassword == $request->cfmpassword){

                    $user       = User::find($userId);
                    $contractor = Contractor::find($userId);

                    if ($user && $userGard == 'web') {
                        $auth = User::where('id', $userId)->first();
                        if(isset($auth->password)){
                            if (Hash::check($request->cpassword, $auth->password)) {
                                $auth->password =  Hash::make($request->mpassword);
                                $auth->update();
                                // Auth::login($auth);
                                Auth::guard('web')->login($auth);
                            }else{
                                return redirect()->back()->with('error', 'current password not matched.');
                            }
                        }else{
                            if($auth->facebook_id != null || $auth->google_id != null){
                                return redirect()->back()->with('error', 'Unable to change password; currently logged in via social account.');
                            }
                        }
                    }elseif($contractor && $userGard == 'contractor') {
                        $auth = Contractor::where('id', $userId)->first();
                        if(isset($auth->password)){
                            if (Hash::check($request->cpassword, $auth->password)) {
                                $auth->password =  Hash::make($request->mpassword);
                                $auth->update();
                                Auth::guard('contractor')->login($auth);
                            }else{
                                return redirect()->back()->with('error', 'current password not matched.');
                            }
                        }else{
                            if($auth->facebook_id != null || $auth->google_id != null){
                                return redirect()->back()->with('error', 'Unable to change password; currently logged in via social account.');
                            }
                        }    
                    }else{
                        return redirect()->back()->with('error', 'current password not matched.');
                    }
                }
            }else{
                return redirect()->back()->with('error', 'login required.');
            }
        } catch (\Exception $ex) {
            return redirect()->back()->with('success', $ex->getMessage());
        }
        return redirect()->back()->with('success', 'password updated successfully.');
    }
}
 