<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- Facade add karein

class AppointmentController extends Controller
{
    public function myAppointments()
    {
        $appointments = Appointment::with('lawyer')
            ->where('customer_id', Auth::id()) // <-- Auth::id() write karein
            ->latest()
            ->get();

        return view('customer.myappointments', compact('appointments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'lawyer_id'        => 'required',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'meeting_type'     => 'required|string',
            'case_summary'     => 'nullable|string',
        ]);

        Appointment::create([
            'lawyer_id'        => $request->lawyer_id,
            'customer_id'      => Auth::id(), // <-- Auth::id() write karein
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'meeting_type'     => $request->meeting_type,
            'case_summary'     => $request->case_summary,
            'status'           => 'pending',
        ]);

        return redirect()->route('customer.myappointments')->with(
            'success',
            'Appointment booked successfully!'
        );
    }
}
