<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Lawyer;
use App\Models\City;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerSidebarController extends Controller
{
    /**
     * Customer Dashboard Overview (Analytics Cards & Recent Appointments)
     */
    public function overview()
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

        return view('customer.overview', compact(
            'totalAppointments',
            'pendingAppointments',
            'approvedAppointments',
            'completedAppointments',
            'cancelledAppointments',
            'recentAppointments'
        ));
    }

    /**
     * Find Lawyer Page with Search & Filters
     */
    public function findLawyer(Request $request)
    {
        $query = Lawyer::with(['user', 'city', 'service']);

        // Search Input Filter
        if ($request->filled('q')) {
            $search = $request->q;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        // City Filter
        if ($request->filled('city')) {
            $query->where('city_id', $request->city);
        }

        // Service Filter
        if ($request->filled('spec')) {
            $query->where('service_id', $request->spec);
        }

        $lawyers  = $query->latest()->get();
        $cities   = City::all();
        $services = Service::all();

        return view('customer.findlawyer', compact('lawyers', 'cities', 'services'));
    }

    /**
     * Logged-in Customer ki sari Appointments History Table
     */
    public function myAppointments()
    {
        $userId = Auth::id();

        $appointments = Appointment::with(['lawyer.user', 'lawyer.service', 'lawyer.city'])
            ->where('customer_id', $userId)
            ->latest()
            ->get();

        return view('customer.myappointments', compact('appointments'));
    }

    /**
     * Customer Profile View
     */
    public function myProfile()
    {
        $user = Auth::user();
        return view('customer.myprofile', compact('user'));
    }

    /**
     * Profile Settings View
     */
    public function profileSettings()
    {
        $user = Auth::user();
        return view('customer.profilesettings', compact('user'));
    }


    public function history()
{
    $userId = auth()->id();

    // Sirf completed aur cancelled appointments History ke liye
   $appointments = Appointment::with('lawyer.user')
    ->where('customer_id', $userId)
    ->whereIn('status', ['completed', 'cancelled'])
    ->latest()
    ->paginate(10);

    return view('customer.history', compact('appointments'));
}
}
