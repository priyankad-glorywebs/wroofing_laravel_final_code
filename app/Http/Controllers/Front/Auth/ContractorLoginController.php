<?php
namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ContractorLoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ContractorLoginController extends Controller
{
    // contractor login form 
    public function ContractorshowLoginForm()
    {
        $contractor = auth()->guard('contractor')->user();
        if ($contractor) {
            return redirect()->route('contractor.dashboard');
        }
        return view('layouts.front.Auth.contractor.contarctorlogin');
    }

    public function Contractorlogin(ContractorLoginRequest $request)
    {
        try {
            $credentials = $request->only('email', 'password');
            $contractor = \App\Models\Contractor::where('email', $credentials['email'])->first();
            if ($contractor) {
                if ($contractor->email_verified_at !== null) {
                    if (Hash::check($credentials['password'], $contractor->password)) {
                        Auth::guard('contractor')->login($contractor, $request->filled('remember'));
                        if ($request->filled('remember')) {
                        } else {
                        }
                        return redirect()->route('contractor.dashboard');
                    } else {
                        return redirect()->back()->withInput()->with(['error' => 'Invalid email or password.']);
                    }
                } else {
                    return redirect()->back()->with(['error' => 'Your email is not verified. Please check your email for the verification link.']);
                }
            } else {
                return redirect()->back()->withInput()->with(['error' => 'Invalid email or password.']);
            }
        } catch (\Exception $exception) {
            \Log::error($exception);
            // return redirect()->route('error.page')->with('error', 'An unexpected error occurred.');
        }
    }
    // logout method for contractor
    public function logoutContractor(Request $request)
    {
        Auth::guard('contractor')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('contractor.login')
            ->withSuccess('You have logged out successfully!');
    }
}