<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Feedback;
use App\Models\Lawyer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    /**
     * Store customer feedback
     */
    public function store(Request $request)
    {
        $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        // Appointment find karo
        $appointment = Appointment::where('id', $request->appointment_id)
            ->where('customer_id', Auth::id())
            ->where('status', 'completed')
            ->first();

        // Agar appointment customer ki nahi hai
        if (!$appointment) {
            return back()->with('error', 'You are not allowed to give feedback for this appointment.');
        }

        // Check karo feedback already diya hai ya nahi
        if (Feedback::where('appointment_id', $appointment->id)->exists()) {
            return back()->with('error', 'You have already submitted feedback for this appointment.');
        }

        // Feedback save karo
        Feedback::create([
            'appointment_id' => $appointment->id,
            'customer_id' => Auth::id(),
            'lawyer_id' => $appointment->lawyer_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Thank you! Your feedback has been submitted successfully.');
    }


    /**
     * Lawyer feedback page
     */
    public function lawyerFeedback()
    {
        // Current logged-in lawyer ka profile
        $lawyer = Lawyer::where('user_id', Auth::id())->first();

        if (!$lawyer) {
            abort(404, 'Lawyer profile not found.');
        }

        // Sirf isi lawyer ke feedback
        $feedbacks = Feedback::with([
            'customer',
            'appointment'
        ])
            ->where('lawyer_id', $lawyer->id)
            ->latest()
            ->get();

        // Average rating
        $averageRating = $feedbacks->avg('rating');

        return view('lawyer.feedback', compact(
            'feedbacks',
            'averageRating'
        ));
    }
}