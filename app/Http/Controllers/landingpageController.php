<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Lawyer;

class landingpageController extends Controller
{
    // 1. Welcome / Landing Page (Root '/')
    public function index()
    {
        $lawyers = Lawyer::select('id', 'image', 'specialization', 'city', 'experience', 'fee', 'bio', 'is_verified')
            ->latest()
            ->take(6)
            ->get();

        return view('welcome', compact('lawyers'));
    }

    // 2. Find Lawyer Page ('/FindLawyer')
    public function findLawyer(Request $request)
    {
        $query = Lawyer::select('id', 'name', 'image', 'specialization', 'city', 'experience', 'fee', 'is_verified');

        if ($request->filled('q')) {
            $search = trim($request->q);
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('specialization', 'like', "%{$search}%");
            });
        }

        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }

        if ($request->filled('spec')) {
            $query->where('specialization', $request->spec);
        }

        $lawyers = $query->latest()->get();

        $cities = Lawyer::whereNotNull('city')->where('city', '!=', '')->distinct()->pluck('city');
        $specializations = Lawyer::whereNotNull('specialization')->where('specialization', '!=', '')->distinct()->pluck('specialization');

        return view('findLawyer', compact('lawyers', 'cities', 'specializations'));
    }

   public function lawyerProfile($id)
{
    $lawyer = Lawyer::findOrFail($id);

    // 'user.' hata diya kyunke file direct views folder mein hai
    return view('lawyer_profile', compact('lawyer'));
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
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
        ]);

        $data = $request->all();

        Mail::raw(
            "Name: {$data['name']}\n" .
            "Email: {$data['email']}\n" .
            "Phone: {$data['phone']}\n\n" .
            "Message:\n{$data['message']}",
            function ($message) use ($data) {
                $message->to('support@legalease.pk')
                        ->subject("Contact Form: " . $data['subject']);
            }
        );

        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
}
