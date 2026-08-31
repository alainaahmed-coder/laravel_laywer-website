<?php

namespace App\Http\Controllers;

use App\Models\city;
use App\Models\service;
use App\Models\Lawyer;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;

class admindashboardController extends Controller
{
    public function admindashboard()
{
    $lawyers = Lawyer::count();
    $Customers = User::where('role', 'customer')->count();
    $totleCities = City::count();

    // Appointments fetch karein (baqi sab data ke saath)
    $appointments = Appointment::with(['lawyer.user', 'customer'])->latest()->get();

    return view('admin.dashboard', compact('lawyers', 'Customers', 'totleCities', 'appointments'));
}

    ///////////////////////////////////
    ///////// Lawyers Functions //////
    /////////////////////////////////
    public function lawyerList()
    {
        $lawyers = Lawyer::with([
            'user',
            'city',
            'service'
        ])->latest()->get();

        return view('admin.Lawyer', compact('lawyers'));
    }
    public function toggleLawyerStatus($id)
    {
        $lawyer = Lawyer::findOrFail($id);
        $lawyer->is_active = !$lawyer->is_active;
        $lawyer->save();

        return redirect()->back()->with('success', 'Lawyer status updated successfully!');
    }

    public function deleteLawyer($id)
    {
        $lawyer = Lawyer::findOrFail($id);
        $lawyer->delete();

        return redirect()->back()->with('success', 'Lawyer deleted successfully!');
    }

    ///////////////////////////////////
    ///////// Add services  //////////
    /////////////////////////////////
    public function serviceStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:20',
        ]);

        service::create([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Service added successfully!');
    }

    public function updateService(Request $request, $id)
    {
        $services = service::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:20',
        ]);

        $services->name = $request->name;
        $services->save();

        return redirect()->back()->with('success', 'Service updated successfully!');
    }

    public function deleteService($id)
    {
        $services = service::findOrFail($id);
        $services->delete();

        return redirect()->back()->with('success', 'Service deleted successfully!');
    }

    ////////////////////////////////
    /////// Cities Functions //////
    //////////////////////////////
    public function citieStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:20',
        ]);

        city::create([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'City added successfully!');
    }

    public function updateCities(Request $request, $id)
    {
        $Cities = city::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:20',
        ]);

        $Cities->name = $request->name;
        $Cities->save();

        return redirect()->back()->with('success', 'City updated successfully!');
    }

    public function deleteCities($id)
    {
        $city = city::findOrFail($id);
        $city->delete();

        return redirect()->back()->with('success', 'City deleted successfully!');
    }
}
