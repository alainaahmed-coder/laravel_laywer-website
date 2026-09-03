<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class customerdashboardController extends Controller
{
    function customerdashboard()
    {
        $userId = Auth::id();

        // 1. Dashboard Cards ke Stats (Counts)
        $totalAppointments     = Appointment::where('customer_id', $userId)->count();
        $pendingAppointments   = Appointment::where('customer_id', $userId)->where('status', 'pending')->count();
        $approvedAppointments  = Appointment::where('customer_id', $userId)->where('status', 'approved')->count();
        $completedAppointments = Appointment::where('customer_id', $userId)->where('status', 'completed')->count();
        $cancelledAppointments = Appointment::where('customer_id', $userId)->where('status', 'cancelled')->count();

        // 2. Overview Table ke liye Recent 5 Appointments
        $recentAppointments = Appointment::with(['lawyer.user'])
            ->where('customer_id', $userId)
            ->latest()
            ->take(5)
            ->get();


        return view('customer.dashboard', compact(
            'totalAppointments',
            'pendingAppointments',
            'approvedAppointments',
            'completedAppointments',
            'cancelledAppointments',
            'recentAppointments'
        ));
    }
}
