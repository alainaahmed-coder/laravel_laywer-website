<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use Exception;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function about()
    {
        return view('user.about-us');
    }

    public function contact()
    {
        return view('user.contact-us');
    }

    public function sendContactForm(Request $request)
{
    $validatedData = $request->validate([
        'name'    => 'required|string|max:255',
        'email'   => 'required|email',
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
    ]);

    try {
        Mail::to('alainaahmed911@gmail.com')->send(new ContactFormMail($validatedData));
        return back()->with('success', 'Thank you! Your message has been sent successfully.');
    } catch (Exception $e) {
        // Return the exact error to screen
        return back()->withErrors(['email_error' => 'Email Error: ' . $e->getMessage()]);
    }
}
}

