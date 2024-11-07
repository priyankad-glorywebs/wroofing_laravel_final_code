<?php

// app/Http/Controllers/SocialGoogleController.php

namespace App\Http\Controllers;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\Contractor;
use App\Models\SocialAccount;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Ramsey\Uuid\Uuid; // Import UUID library
use Illuminate\Support\Facades\Hash;

class SocialGoogleController extends Controller
{
    public function redirectToGoogle(Request $request)
    {
        // Store the 'type' query parameter in the session
        $request->session()->put('google_login_type', $request->query('type'));
        // Check if a user is already authenticated
        if (Auth::check()) {
            // If so, logout the user
            Auth::logout();
        }
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            $userType = $request->session()->get('google_login_type');
            if ($userType === 'customer') {
                $user = $this->findOrCreateUser($googleUser); 
                if ($user) {
                    $request->session()->put('Auth', $user);
                    // You can add additional logic here, such as logging in the user or redirecting
                    Auth::login($user);
                    return redirect()->route('project.list');
                } else {
                    return redirect()->route('login')->with('error', 'Invalid credentials.');
                }
            } elseif ($userType === 'contractor') {
                $contractor = $this->findOrCreateContractor($googleUser);
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
            \Log::error('Google Login Error: ' . $e->getMessage());
            
            // Return a response to the user indicating an error occurred
            return response()->json(['error' => 'An error occurred during Google login. Please try again later.'], 500);
        }    
    }
    
    protected function findOrCreateUser($googleUser)
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

        try{
            $user = User::where('email', $googleUser->getEmail())->first(); 
            if (empty($user) && isset($googleUser)) {
                // Extract required information from the $googleUser object
                $provider           = 'google'; // You already know the provider is Google
                $providerUserId     = $googleUser->getId();
                $email              = $googleUser->getEmail();
                $name               = $googleUser->getName();
                $avatar             = $googleUser->getAvatar();
                $token              = $googleUser->token;

                $user                       = new User;
                $user->id                   = $integerUuid;
                $user->name                 = $googleUser->getName();
                $user->email                = $googleUser->getEmail();
                $user->google_id            = $googleUser->getId();
                $user->password             = Hash::make($googleUser->getEmail());
                $user->contact_number       = null;
                $user->zip_code             = null;
                $user->status               = 'Active';
                $user->updated_at           = now();
                $user->email_verified_at    = now();
                $user->save();

                $SocialAccount                   = new SocialAccount;
                $SocialAccount->user_id          = $user->id;
                $SocialAccount->provider         = $provider;
                $SocialAccount->provider_user_id = $providerUserId;
                $SocialAccount->email            = $email;
                $SocialAccount->name             = $name;
                $SocialAccount->avatar           = $avatar;
                $SocialAccount->token            = $token;
                $SocialAccount->social_type      = $provider;
                $SocialAccount->role_type        = 'customer';
                $SocialAccount->save();
            }else{
                
                $provider           = 'google'; // You already know the provider is Google
                $providerUserId     = $googleUser->getId();
                $email              = $googleUser->getEmail();
                $name               = $googleUser->getName();
                $avatar             = $googleUser->getAvatar();
                $token              = $googleUser->token;

                $user->update([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'status' => 'Active',
                    'updated_at' => now(),
                ]); 

                if($user == true){
                    $user = User::where('google_id', $googleUser->getId())->first();
                }

                try {
                    $SocialAccount = SocialAccount::where([
                        'user_id' => $user->id,
                        'provider_user_id' => $providerUserId,
                        'social_type' => 'google',
                        'role_type' => 'customer',
                    ])->first();
                    
                    if(empty($SocialAccount) && $SocialAccount == null){
                        $SocialAccount                   = new SocialAccount;
                    }

                    $SocialAccount->user_id          = $user->id;
                    $SocialAccount->provider         = $provider;
                    $SocialAccount->provider_user_id = $providerUserId;
                    $SocialAccount->email            = $email;
                    $SocialAccount->name             = $name;
                    $SocialAccount->avatar           = $avatar;
                    $SocialAccount->token            = $token;
                    $SocialAccount->social_type      = $provider;
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
        } catch (Exception $exception) {
            return response()->json(['success'=>'error',  'message'=>'something is wrong']); 
        }
        return $user;
    }

    protected function findOrCreateContractor($googleUser)
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
        $user = Contractor::where('email', $googleUser->getEmail())->first();
        
        if (empty($user) && isset($googleUser)) {
            // Extract required information from the $googleUser object
            $provider           = 'google'; // You already know the provider is Google
            $providerUserId     = $googleUser->getId();
            $email              = $googleUser->getEmail();
            $name               = $googleUser->getName();
            $avatar             = $googleUser->getAvatar();
            $token              = $googleUser->token;
            /* set random password */
            Log::info('Not Issue');

            $user               = new Contractor;
            $user->id           = $integerUuid;
            $user->name         = $name;
            $user->email        = $email;
            $user->google_id    = $providerUserId;
            $user->status       = 'Active';
            $user->company_logo = null;;
            $user->password     = Hash::make($googleUser->getEmail());
            $user->updated_at   = now();
            $user->email_verified_at = now();
            $user->save();

            Log::info('Issue occur');
            try {
                $SocialAccount                   = new SocialAccount;
                $SocialAccount->user_id          = $user->id;
                $SocialAccount->provider         = isset($provider) ? $provider : 'google';
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
            $provider           = 'google'; // You already know the provider is Google
            $providerUserId     = $googleUser->getId();
            $email              = $googleUser->getEmail();
            $name               = $googleUser->getName();
            $avatar             = $googleUser->getAvatar();
            $token              = $googleUser->token;
            
            $user = Contractor::find($user->id);
            $user->update([
                'name' => $name,
                'email' =>  $email,
                'google_id' => $providerUserId,
                'company_logo' => 'null',
                'status' => 'Active',
                'updated_at' => now(),
            ]);

            if($user == true){
                $user = Contractor::where('google_id', $googleUser->getId())->first();
            }
 
            try {
                $SocialAccount = SocialAccount::where([
                    'user_id' => $user->id,
                    'provider_user_id' => $providerUserId,
                    'social_type' => 'google',
                    'role_type' => 'contractor',
                ])->first();
                
                if(empty($SocialAccount) && $SocialAccount == null){
                    $SocialAccount                   = new SocialAccount;
                }

                $SocialAccount->user_id          = $user->id;
                $SocialAccount->provider         = isset($provider) ? $provider : 'google';
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
   public function list(){
        return view('layouts.front.projects.project-list');
    }
}