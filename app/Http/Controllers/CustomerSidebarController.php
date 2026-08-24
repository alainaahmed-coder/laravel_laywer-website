<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerSidebarController extends Controller
{
    public function overview()
    {
        return view('customer.sidebar.overview');
    }

    public function findLawyer()
    {
        return view('customer.sidebar.find-lawyer');
    }

    public function myAppointments()
    {
        return view('customer.sidebar.my-appointments');
    }

    public function myProfile()
    {
        return view('customer.sidebar.my-profile');
    }

    public function profileSettings()
    {
        return view('customer.sidebar.profile-settings');
    }
}
