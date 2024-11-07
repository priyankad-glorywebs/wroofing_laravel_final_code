<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Contractor;

class ResetPasswordController extends Controller
{
    // showResetPasswordForm  method 
    public function showResetPasswordForm($token)
    {
        try {
            $data = PasswordReset::where('token', $token)->first();
            return view('layouts.front.Auth.resetpassword', ['data' => $data]);
        } catch (\Exception $exception) {
            return redirect()->route('error.page')->with('error', 'An unexpected error occurred.');
        }
    }

    //  public function submitResetPasswordForm(ResetPasswordRequest $request)
    public function submitResetPasswordForm(Request $request)
    {

        $passwordReset = DB::table('password_resets')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$passwordReset || !$this->tokenValid($passwordReset)) {
            return back()->withInput()->with('error', 'Invalid or expired token!');
        }

        User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);
        DB::table('password_resets')->where('email', $request->email)->delete();

        return redirect('customer/login')->with('message', 'Your password has been changed!');

    }


    protected function tokenValid($passwordReset)
    {
        $expirationTime = config('auth.passwords.' . config('auth.defaults.passwords') . '.expire');

        return Carbon::parse($passwordReset->created_at)->addMinutes($expirationTime)->isFuture();
    }

}
