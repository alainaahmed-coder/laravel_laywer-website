<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminSidebarController extends Controller
{
    public function approvals()
    {
        return view('admin.sidebar.approvals');
    }

    public function customers()
    {
        return view('admin.sidebar.customers');
    }

    public function cities()
    {
        return view('admin.sidebar.cities');
    }

    public function services()
    {
        return view('admin.sidebar.services');
    }

    public function schedules()
    {
        return view('admin.sidebar.schedules');
    }

    public function appointments()
    {
        return view('admin.sidebar.appointments');
    }

    public function websiteContent()
    {
        return view('admin.sidebar.website-content');
    }

    public function settings()
    {
        return view('admin.sidebar.settings');
    }
}
