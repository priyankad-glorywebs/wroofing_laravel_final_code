<?php
namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use Hash;

class LoginController extends Controller
{
    // Display a Login form 
    public function showLoginForm()
    {
        return view('layouts.front.Auth.login');
    }
    // post request for login form
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            if ($request->filled('remember')) {
            } else {
            }
            return redirect()->route('project.list');
        }
        return redirect()->back()->withInput()->with(['error' => 'Invalid email or password.']);
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
            ->withSuccess('You have logged out successfully!');
        ;
    }
}