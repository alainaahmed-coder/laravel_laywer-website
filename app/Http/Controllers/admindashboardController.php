<?php

namespace App\Http\Controllers;

use App\Models\city;
use App\Models\services;
use App\Models\Lawyer;
use Illuminate\Http\Request;

class admindashboardController extends Controller
{
    public function admindashboard()
    {
        return view('admin.dashboard');
    }

    ///////////////////////////////////
    ///////// Lawyers Functions //////
    /////////////////////////////////
  public function lawyerList()
{
    $lawyers = Lawyer::all();
    return view('admin.Lawyer', compact('lawyers')); // Capital 'L' aur singular
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

        services::create([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Service added successfully!');
    }

    public function updateService(Request $request, $id)
    {
        $services = services::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:20',
        ]);

        $services->name = $request->name;
        $services->save();

        return redirect()->back()->with('success', 'Service updated successfully!');
    }

    public function deleteService($id)
    {
        $services = services::findOrFail($id);
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
