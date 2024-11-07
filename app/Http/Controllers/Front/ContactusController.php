<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Mail;
use App\Mail\ContactFormSubmitted; 


class ContactusController extends Controller
{
    public function contactus(){
        return view('layouts.front.contactus');
    }

    
public function store(Request $request)
{

    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phoneno' => 'required|string|max:12',
        'country_code' => 'required|string',
        'address' => 'required|string|max:255',
        'yourcomments' => 'required|string|max:255',
    ]);

    $contact = Contact::create($validatedData);

    Mail::to($contact->email)->send(new ContactFormSubmitted($contact));

    return redirect()->back()->with('success', 'Your message has been submitted successfully. We will get back to you soon.');
}


    //term and condition page 
    public function term(){
        return view('layouts.front.termandcondition');
    }
    public function aboutus(){
        return view('layouts.front.about-us');
    }
}
