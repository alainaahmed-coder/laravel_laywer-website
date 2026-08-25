<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminSidebarController extends Controller
{
    public function approvals()
    {
        return view('admin.approvals');
    }

    public function customers()
    {
        return view('admin.customers');
    }

    public function cities()
    {
        return view('admin.cities');
    }

    public function services()
    {
        return view('admin.services');
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
