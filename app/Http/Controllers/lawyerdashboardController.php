<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class lawyerdashboardController extends Controller
{
    public function lawyerdashboard()
    {
        $lawyerId = Auth::id();

        // Simple Dynamic Counters
        $pendingAppointments = Appointment::where('lawyer_id', $lawyerId)->where('status', 'pending')->count();
        $approvedAppointments = Appointment::where('lawyer_id', $lawyerId)->where('status', 'approved')->count();
        $completedAppointments = Appointment::where('lawyer_id', $lawyerId)->where('status', 'completed')->count();

        // Total appointments count as total clients representation
        $totalClients = Appointment::where('lawyer_id', $lawyerId)->count();

        // Recent Appointments List
        $recentAppointments = Appointment::where('lawyer_id', $lawyerId)
            ->latest()
            ->take(5)
            ->get();

        return view('lawyer.dashboard', compact(
            'pendingAppointments',
            'approvedAppointments',
            'completedAppointments',
            'totalClients',
            'recentAppointments'
        ));
    }
}
