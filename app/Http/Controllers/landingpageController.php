<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail; // 👈 1. Yeh Import add karein

class landingpageController extends Controller
{
    public function findLawyer()
    {
        return view('findLawyer');
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function contactSend(Request $request)
    {
        // 1. Validation
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
        ]);

        // 2. Email Sending Code (YEH ADD KAREIN)
        $data = $request->all();

        Mail::raw(
            "Name: {$data['name']}\n" .
            "Email: {$data['email']}\n" .
            "Phone: {$data['phone']}\n\n" .
            "Message:\n{$data['message']}",
            function ($message) use ($data) {
                $message->to('support@legalease.pk') // 👈 Yahan woh Email dalein jahan msg receive karna hai
                        ->subject("Contact Form: " . $data['subject']);
            }
        );

        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
}
