<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Service;

class AdminSidebarController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function customers()
    {
        return view('admin.customers');
    }

    // Cities
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


    public function schedules()
    {
        return view('admin.schedules');
    }


    public function appointments()
    {
        return view('admin.appointments');
    }


    public function websiteContent()
    {
        return view('admin.websitecontent');
    }


  public function settings()
{
    $user = auth()->user();

    return view('admin.settings', compact('user'));
}
}