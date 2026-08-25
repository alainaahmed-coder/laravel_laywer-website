<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerSidebarController extends Controller
{
    public function overview()
    {
        return view('customer.overview');
    }

    public function findLawyer()
    {
        return view('customer.findlawyer');
    }

    public function myAppointments()
    {
        return view('customer.myappointments');
    }

    public function myProfile()
    {
        return view('customer.myprofile');
    }

    public function profileSettings()
    {
        return view('customer.profilesettings');
    }
}
