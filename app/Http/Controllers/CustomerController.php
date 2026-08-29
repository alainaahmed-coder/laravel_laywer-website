<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    // ==========================================
    // ADMIN PANEL METHODS (Customer Management)
    // ==========================================

    // Sirf 'customer' role wale users fetch honge
    public function index()
    {
        $customers = User::where('role', 'customer')->latest()->get();
        return view('admin.customers', compact('customers'));
    }

    // Naya Customer Add karne ke liye
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'customer',
        ]);

        return redirect()->back()->with('success', 'Customer added successfully!');
    }

    // Customer Update karne ke liye
    public function update(Request $request, $id)
    {
        $customer = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;

        if ($request->filled('password')) {
            $customer->password = Hash::make($request->password);
        }

        $customer->save();

        return redirect()->back()->with('success', 'Customer updated successfully!');
    }

    // Customer Delete karne ke liye
    public function destroy($id)
    {
        $customer = User::findOrFail($id);
        $customer->delete();

        return redirect()->back()->with('success', 'Customer deleted successfully!');
    }


    // ==========================================
    // CUSTOMER DASHBOARD METHODS (My Profile)
    // ==========================================

    // My Profile View
    public function myProfile()
    {
        $user = Auth::user();
        // Yeh view usi customer.myprofile file par point karega jo aapne banayi hai
        return view('customer.myprofile', compact('user'));
    }

public function updateProfile(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $request->validate([
            'name'            => 'required|string|max:255',
            'email'           => 'required|email|unique:users,email,' . $user->id,
            'phone'           => 'nullable|string|max:20',
            'city'            => 'nullable|string|max:100',
            'address'         => 'nullable|string|max:500',
            'cnic'            => 'nullable|string|max:20',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user->name    = $request->name;
        $user->email   = $request->email;
        $user->phone   = $request->phone;
        $user->city    = $request->city;
        $user->address = $request->address;
        $user->cnic    = $request->cnic;

        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture && file_exists(public_path('uploads/profile/' . $user->profile_picture))) {
                unlink(public_path('uploads/profile/' . $user->profile_picture));
            }

            $file = $request->file('profile_picture');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/profile'), $filename);
            $user->profile_picture = $filename;
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    }
