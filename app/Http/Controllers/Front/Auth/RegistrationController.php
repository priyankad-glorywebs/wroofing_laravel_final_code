<?php
namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ContractorRegisterRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
use App\Models\Contractor;
use App\Models\User;  // model
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid; // Import UUID library

class RegistrationController extends Controller
{
    public function registerStepOne(Request $request)
    {
        return view('layouts.front.Auth.design-studio');
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'areyoua' => 'required',
            'name' => 'required|string|max:255',
            'password' => 'required|max:255',
            'password_confirmation' => 'required|max:255',
            'address' => 'required|max:255',
        ]);

        // Conditionally add the company_name rule if it is present in the request
        $validator->sometimes('company_name', 'string|max:255', function ($input) {
            return isset($input->company_name);
        });

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Generate a UUID
        $uuid = Uuid::uuid4()->toString();

        // Convert the UUID string to an integer
        $integerUuid = hexdec(substr(md5($uuid), 0, 1));

        // Check for uniqueness
        while (User::where('id', $integerUuid)->exists() || Contractor::where('id', $integerUuid)->exists()) {
            $uuid = Uuid::uuid4()->toString();
            $integerUuid = hexdec(substr(md5($uuid), 0, 1));
        }

        $user = new User;
        $user->id = $integerUuid;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->contact_number = $request->contact_number;
        $user->country_code = $request->country_code;
        $user->zip_code = $request->zip_code;
        $user->address = $request->address;
        if ($request->areyoua === "customer") {
            $validator = Validator::make($request->all(), (new RegisterRequest())->rules());
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $user->save();
            if ($request->hasFile('profile_image')) {
                $image = $request->file('profile_image');
                $imageName = \Str::random(3) . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('customer_image'), $imageName);
                $user->profile_image = 'customer_image/' . $imageName;
                $user->save();
            }
            $user->sendEmailVerificationNotification();
            $usertype = "customer";
        }
        if ($request->areyoua === "contractor") {
            $validator = Validator::make($request->all(), (new ContractorRegisterRequest())->rules());
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $contractor = new Contractor;
            $contractor->id = $integerUuid;
            $contractor->name = $request->name;
            $contractor->email = $request->email;
            $contractor->company_name = $request->company_name ?? '';
            $contractor->password = bcrypt($request->password);
            $contractor->contact_number = $request->contact_number;
            $contractor->country_code =  $request->country_code ?? "us";
            $contractor->zip_code = $request->zip_code;
            $contractor->address = $request->address;
            // $contractor->profile_image         = $profileImageName ? 'uploads/contractor_profile/' . $profileImageName : null;
            // $contractor->contractor_portfolio  = $portfolioPaths;
            $contractor->save();
            $profileImageName = null;
            if ($request->hasFile('profile_image')) {
                $image = $request->file('profile_image');
                $imageName = \Str::random(3) . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('customer_image'), $imageName);
                $contractor->profile_image = 'customer_image/' . $imageName;
                $contractor->save();
            }
            $contractor->sendEmailVerificationNotification();
            $usertype = "contractor";
        }
        return view("layouts.front.Auth.register-thankyou", compact("usertype"));
    }
}