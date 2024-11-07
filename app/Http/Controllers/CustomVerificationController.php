<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Contractor;

class CustomVerificationController extends Controller
{
    public function customVerify(Request $request)
    {
        try {
            $userID = (int) $request->id;
            $user = User::where('id', $userID)->first();
            $contractor = Contractor::where('id', $userID)->first();

            // Clear the session
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            if (isset($user) && $user != null) {
                if (!$user->hasVerifiedEmail()) {
                    $user->markEmailAsVerified();
                }
                $request->session()->flash('success', 'Your email verification is successful. You can now log in.');
                return redirect('customer/login');
            } elseif (isset($contractor) && $contractor != null) {
                if (!$contractor->hasVerifiedEmail()) {
                    $contractor->markEmailAsVerified();
                }
                $request->session()->flash('success', 'Your email verification is successful. You can now log in.');
                return redirect('contractor/login');
            }
        } catch (\Exception $ex) {
            $request->session()->flash('error', 'An unexpected error occurred.');
            return redirect('/login');
        }
    }
}
