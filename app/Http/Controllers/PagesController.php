<?php

namespace App\Http\Controllers;

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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Process message (e.g., save to DB or send email)

        return back()->with('success', 'Thank you! Your message has been sent successfully. Our legal team will get back to you shortly.');
    }
}

