<?php

namespace App\Http\Controllers;

use App\Models\city;
use App\Models\services;
use Illuminate\Http\Request;

class admindashboardController extends Controller
{
    function admindashboard()
    {
        return view('admin.dashboard');
    }
    ///////////////////////////////////
    ///////// Add services  //////////
    /////////////////////////////////
    public function serviceStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:20',
        ]);

        services::create([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Customer added successfully!');
    }

    // Services Update karne ke liye
    public function updateService(Request $request, $id)
    {
        $services = services::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:20',
        ]);

        $services->name = $request->name;
        $services->save();

        return redirect()->back()->with('success', 'Customer updated successfully!');
    }
    ////////// delete services ///////////
    public function deleteService($id)
    {
        $services = services::findOrFail($id);
        $services->delete();

        return redirect()->back()->with('success', 'Customer deleted successfully!');
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
    // Services Update karne ke liye
    public function updateCities(Request $request, $id)
    {
        $Cities = city::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:20',
        ]);

        $Cities->name = $request->name;
        $Cities->save();

        return redirect()->back()->with('success', 'Customer updated successfully!');
    }
     ////////// delete services ///////////
    public function deleteCities($id)
    {
        $city = city::findOrFail($id);
        $city->delete();

        return redirect()->back()->with('success', 'Customer deleted successfully!');
    }
}
