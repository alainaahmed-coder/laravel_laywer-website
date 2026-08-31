<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Service;
use App\Models\Appointment;
use App\Models\Lawyer;
use App\Models\User;

class AdminSidebarController extends Controller
{
    public function dashboard()
    {
        $lawyers = Lawyer::all()->count();
        $Customers = User::where('role','customer')->get()->count();
        $totleCities = City::all()->count();
        $appoinmnets = Appointment::with(['lawyer','customer'])->where('status','pending')->latest()->get();
        return view('admin.dashboard', compact('lawyers', 'Customers', 'totleCities','appoinmnets'));
    }

    public function customers()
    {
        return view('admin.customers');
    }


    // ================= CITIES =================

    public function cities()
    {
        $cities = City::latest()->get();

        return view('admin.cities', compact('cities'));
    }


    // New City Save
    public function storeCity(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:cities,name'
        ]);

        City::create([
            'name' => $request->name
        ]);

        return redirect()
            ->back()
            ->with('success', 'City added successfully!');
    }


    // City Update
    public function updateCity(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:cities,id',
            'name' => 'required|string|max:255'
        ]);

        $city = City::findOrFail($request->id);

        $city->update([
            'name' => $request->name
        ]);

        return redirect()
            ->back()
            ->with('success', 'City updated successfully!');
    }


    // City Delete
    public function destroyCity(Request $request)
    {
        $city = City::findOrFail($request->id);

        $city->delete();

        return redirect()
            ->back()
            ->with('success', 'City deleted successfully!');
    }



    // ================= SERVICES =================

    public function services()
    {
        $services = Service::latest()->get();

        return view('admin.services', compact('services'));
    }



    // ================= SCHEDULES =================

    public function schedules()
    {
        return view('admin.schedules');
    }



    // ================= APPOINTMENTS =================

   // ================= APPOINTMENT HISTORY =================

public function appointmentHistory()
{
    $appointments = Appointment::with('customer')
        ->whereHas('lawyer', function ($query) {
            $query->where('user_id', Auth::id());
        })
        ->where('status', 'completed')
        ->latest('appointment_date')
        ->latest('appointment_time')
        ->get();

    return view('lawyer.appointmenthistory', compact('appointments'));
}


    // ================= WEBSITE CONTENT =================

    public function websiteContent()
    {
        return view('admin.websitecontent');
    }



    // ================= SETTINGS =================

    public function settings()
    {
        $user = auth()->user();

        return view('admin.settings', compact('user'));
    }
}
