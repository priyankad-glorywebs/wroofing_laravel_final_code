<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SendResetLinkEmailRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Mail\ForgetPasswordEmail;
use App\Models\User;
use App\Models\Contractor;


class ForgotPasswordController extends Controller
{
    // Display a Forgot password 
    public function forgotPassword()
    {
        return view('layouts.front.Auth.forgotpassword');
    }

    //post request for forget password

    public function sendResetLinkEmail(SendResetLinkEmailRequest $request)
    {
        try {

            $email = $request->email;
            $token = Str::random(64);
            DB::table('password_resets')->insert([
                'email' => $email,
                'token' => $token,
                'created_at' => now(),
            ]);

            $resetLink = url("customer/reset-password/{$token}");
            mail::to($email)->send(new ForgetPasswordEmail($resetLink));

            return back()->with('message', 'We have e-mailed your password reset link!');
        } catch (\Exception $exception) {
        }
    }
}
