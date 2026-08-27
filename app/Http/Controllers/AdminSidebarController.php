<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City; // 👈 1. City Model import karein
use App\Models\services;

class AdminSidebarController extends Controller
{
    public function dashboard(){
        return view('admin.dashboard');
    }
    

    public function customers()
    {
        return view('admin.customers');
    }

    // 👈 2. Cities Page (Data pass kar diya)
    public function cities()
    {
        $cities = City::latest()->get(); // Database se cities mangwai
        return view('admin.cities', compact('cities'));
    }

    // 👈 3. New City Save karne ke liye
    public function storeCity(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:cities,name'
        ]);

        City::create([
            'name' => $request->name
        ]);

        return redirect()->back()->with('success', 'City added successfully!');
    }

    // 👈 4. City Update karne ke liye
    public function updateCity(Request $request)
    {
        $request->validate([
            'id'   => 'required|exists:cities,id',
            'name' => 'required|string|max:255'
        ]);

        $city = City::findOrFail($request->id);
        $city->update([
            'name' => $request->name
        ]);

        return redirect()->back()->with('success', 'City updated successfully!');
    }

    // 👈 5. City Delete karne ke liye
    public function destroyCity(Request $request)
    {
        $city = City::findOrFail($request->id);
        $city->delete();

        return redirect()->back()->with('success', 'City deleted successfully!');
    }

    public function services()
    {
         $services = services::latest()->get(); // Database se cities mangwai
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
        return view('admin.settings');
    }
}
