<?php

// app/Http/Controllers/SocialFacebookController.php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Contractor;
use App\Models\SocialAccount;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Ramsey\Uuid\Uuid; // Import UUID library
use Illuminate\Support\Facades\Hash;

class SocialFacebookController extends Controller
{
    public function redirectToFacebook(Request $request)
    {
        // Store the 'type' query parameter in the session
        $request->session()->put('facebook_login_type', $request->query('type'));
        // Check if a user is already authenticated
        if (Auth::check()) {
            // If so, logout the user
            Auth::logout();
        }
        return Socialite::driver('facebook')->stateless()->redirect();
    }

    public function handleFacebookCallback(Request $request)
    {   
        try {
            $facebookUser = Socialite::driver('facebook')->stateless()->user();
            $userType = $request->session()->get('facebook_login_type');

            // Now you can handle the user data based on the type
            if ($userType === 'customer') {
                $user = $this->findOrCreateUser($facebookUser);
                if ($user) {
                    // Handle customer login logic
                    $request->session()->put('Auth', $user);
                    Auth::login($user);
                    return redirect()->route('project.list');
                } else {
                    return redirect()->route('login')->with('error', 'Invalid credentials.');
                }

            } elseif ($userType === 'contractor') {
                $contractor = $this->findOrCreateContractor($facebookUser);
                if ($contractor) {
                    $request->session()->put('Auth', $contractor);
                    Auth::guard('contractor')->login($contractor);
                    return redirect()->route('contractor.dashboard');
                } else {
                    return redirect()->route('login')->with('error', 'Invalid credentials.');
                }
            } else {                
                // Return a response to the user indicating an error occurred
                return response()->json(['error' => 'Invalid user type, handle accordingly'], 500);
            }
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            \Log::error('Facebook Login Error: ' . $e->getMessage());
            
            // Return a response to the user indicating an error occurred
            return response()->json(['error' => 'An error occurred during Facebook login. Please try again later.'], 500);
        }
    }

    protected function findOrCreateUser($facebookUser)
    {
        // Generate a UUID
        $uuid = Uuid::uuid4()->toString();
        // Convert the UUID string to an integer
        $integerUuid = hexdec(substr(md5($uuid), 0, 1));
        // Check for uniqueness
        while (User::where('id', $integerUuid)->exists() || Contractor::where('id', $integerUuid)->exists()) {
            // Regenerate the UUID and integer UUID until unique
            $uuid = Uuid::uuid4()->toString();
            $integerUuid = hexdec(substr(md5($uuid), 0, 1));
        }

        $user = User::where('email', $facebookUser->getEmail())->first();
        if (empty($user) && isset($facebookUser)) {
            // Extract required information from the $googleUser object
            $provider           = 'facebook'; // You already know the provider is Google
            $providerUserId     = $facebookUser->getId();
            $email              = $facebookUser->getEmail();
            $name               = $facebookUser->getName();
            $avatar             = $facebookUser->getAvatar();
            $token              = $facebookUser->token;
            Log::info('Not Issue');

            $user                    = new User;
            $user->id                = $integerUuid;
            $user->name              = $name;
            $user->email             = $email;
            $user->facebook_id       = $providerUserId;
            $user->status            = 'Active';
            $user->contact_number    = null;
            $user->zip_code          = null;
            $user->password          = Hash::make($email);
            $user->updated_at        = now();
            $user->email_verified_at = now();
            $user->save();

            Log::info('Issue occur');
            try {
                $SocialAccount                   = new SocialAccount;
                $SocialAccount->user_id          = $user->id;
                $SocialAccount->provider         = isset($provider) ? $provider : 'facebook';
                $SocialAccount->provider_user_id = isset($providerUserId) ? $providerUserId : null;
                $SocialAccount->email            = $email;
                $SocialAccount->name             = isset($name) ? $name : null;
                $SocialAccount->avatar           = isset($avatar) ? $avatar : null;
                $SocialAccount->token            = isset($token) ? $token : null;
                $SocialAccount->social_type      = isset($provider) ? $provider : null;
                $SocialAccount->role_type        = 'customer';
                $SocialAccount->save();
            } catch (\Exception $e) {
                // Log the error
                \Log::error('Error saving SocialAccount: ' . $e->getMessage());
                
                // Handle the error as needed
                // For example, you can return a response indicating the error to the user
                return response()->json(['error' => 'An error occurred while saving the social account data. Please try again later.'], 500);
            }
        }else{
            // Extract required information from the $googleUser object
            $provider           = 'facebook'; // You already know the provider is Google
            $providerUserId     = $facebookUser->getId();
            $email              = $facebookUser->getEmail();
            $name               = $facebookUser->getName();
            $avatar             = $facebookUser->getAvatar();
            $token              = $facebookUser->token;
            
            $user = User::where('email', $facebookUser->getEmail())->first();
            $user->update([
                'name' => $name,
                'email' => $email,
                'facebook_id' => $providerUserId,
                'status' => 'Active',
                'updated_at' => now(),
            ]);

            if($user == true){
                $user = User::where('facebook_id', $facebookUser->getId())->first();
            }

            try {
                $SocialAccount = SocialAccount::where([
                    'user_id' => $user->id,
                    'provider_user_id' => $providerUserId,
                    'social_type' => 'facebook',
                    'role_type' => 'customer',
                ])->first();
                if(empty($SocialAccount) && $SocialAccount == null){
                    $SocialAccount                   = new SocialAccount;
                }
                $SocialAccount->user_id          = $user->id;
                $SocialAccount->provider         = isset($provider) ? $provider : 'facebook';
                $SocialAccount->provider_user_id = isset($providerUserId) ? $providerUserId : null;
                $SocialAccount->email            = $email;
                $SocialAccount->name             = isset($name) ? $name : null;
                $SocialAccount->avatar           = isset($avatar) ? $avatar : null;
                $SocialAccount->token            = isset($token) ? $token : null;
                $SocialAccount->social_type      = isset($provider) ? $provider : null;
                $SocialAccount->role_type        = 'customer';
                $SocialAccount->save();
            } catch (\Exception $e) {
                // Log the error
                \Log::error('Error saving SocialAccount: ' . $e->getMessage());
                
                // Handle the error as needed
                // For example, you can return a response indicating the error to the user
                return response()->json(['error' => 'An error occurred while saving the social account data. Please try again later.'], 500);
            }
        }
        return $user;
    }
    protected function findOrCreateContractor($facebookUser)
    {
        // Generate a UUID
        $uuid = Uuid::uuid4()->toString();
        // Convert the UUID string to an integer
        $integerUuid = hexdec(substr(md5($uuid), 0, 1));
        // Check for uniqueness
        while (User::where('id', $integerUuid)->exists() || Contractor::where('id', $integerUuid)->exists()) {
            // Regenerate the UUID and integer UUID until unique
            $uuid = Uuid::uuid4()->toString();
            $integerUuid = hexdec(substr(md5($uuid), 0, 1));
        }

        $user = Contractor::where('email', $facebookUser->getEmail())->first();
        if (empty($user) && isset($facebookUser)) {
            // Extract required information from the $googleUser object
            $provider           = 'facebook'; // You already know the provider is Google
            $providerUserId     = $facebookUser->getId();
            $email              = $facebookUser->getEmail();
            $name               = $facebookUser->getName();
            $avatar             = $facebookUser->getAvatar();
            $token              = $facebookUser->token;

            $user               = new Contractor;
            $user->id           = $integerUuid;
            $user->name         = $name;
            $user->email        = $email;
            $user->facebook_id  = $providerUserId;
            $user->status       = 'Active';
            $user->company_logo = null;
            $user->password     = Hash::make($email);
            $user->updated_at   = now();
            $user->email_verified_at = now();
            $user->save();
            try {
                $SocialAccount                   = new SocialAccount;
                $SocialAccount->user_id          = $user->id;
                $SocialAccount->provider         = isset($provider) ? $provider : 'facebook';
                $SocialAccount->provider_user_id = isset($providerUserId) ? $providerUserId : null;
                $SocialAccount->email            = $email;
                $SocialAccount->name             = isset($name) ? $name : null;
                $SocialAccount->avatar           = isset($avatar) ? $avatar : null;
                $SocialAccount->token            = isset($token) ? $token : null;
                $SocialAccount->social_type      = isset($provider) ? $provider : null;
                $SocialAccount->role_type        = 'contractor';
                $SocialAccount->save();
            } catch (\Exception $e) {
                // Log the error
                \Log::error('Error saving SocialAccount: ' . $e->getMessage());
                
                // Handle the error as needed
                // For example, you can return a response indicating the error to the user
                return response()->json(['error' => 'An error occurred while saving the social account data. Please try again later.'], 500);
            }
        }else{
            // Extract required information from the $googleUser object
            $provider           = 'facebook'; // You already know the provider is Google
            $providerUserId     = $facebookUser->getId();
            $email              = $facebookUser->getEmail();
            $name               = $facebookUser->getName();
            $avatar             = $facebookUser->getAvatar();
            $token              = $facebookUser->token;
            $user = Contractor::find($user->id);
            $user = $user->update([
                'name' => $name,
                'email' =>  $email,
                'facebook_id' => $providerUserId,
                'status' => 'Active',
                'company_logo' => 'null',
                'updated_at' => now(),
            ]);

            if($user == true){
                $user = Contractor::where('facebook_id', $facebookUser->getId())->first();
            }

            try {
                $SocialAccount = SocialAccount::where([
                    'user_id' => $user->id,
                    'provider_user_id' => $providerUserId,
                    'social_type' => 'facebook',
                    'role_type' => 'contractor',
                ])->first();
                if(empty($SocialAccount) && $SocialAccount == null){
                    $SocialAccount                   = new SocialAccount;
                }
                $SocialAccount->user_id          = $user->id;
                $SocialAccount->provider         = isset($provider) ? $provider : 'facebook';
                $SocialAccount->provider_user_id = isset($providerUserId) ? $providerUserId : null;
                $SocialAccount->email            = $email;
                $SocialAccount->name             = isset($name) ? $name : null;
                $SocialAccount->avatar           = isset($avatar) ? $avatar : null;
                $SocialAccount->token            = isset($token) ? $token : null;
                $SocialAccount->social_type      = isset($provider) ? $provider : null;
                $SocialAccount->role_type        = 'contractor';
                $SocialAccount->save();
            } catch (\Exception $e) {
                // Log the error
                \Log::error('Error saving SocialAccount: ' . $e->getMessage());
                
                // Handle the error as needed
                // For example, you can return a response indicating the error to the user
                return response()->json(['error' => 'An error occurred while saving the social account data. Please try again later.'], 500);
            }
        }
        return $user;
    }

    public function list()
    {
        return view('layouts.front.projects.project-list');
    }
} 
