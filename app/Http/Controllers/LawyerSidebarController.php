<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LawyerSidebarController extends Controller
{
    public function overview()
    {
        return view('lawyer.overview');
    }

    public function profile()
    {
        return view('lawyer.profile');
    }

    public function services()
    {
        return view('lawyer.sidebar.services');
    }

    public function schedule()
    {
        return view('lawyer.sidebar.schedule');
    }

    public function clients()
    {
        return view('lawyer.sidebar.clients');
    }

    public function appointmentHistory()
    {
        return view('lawyer.sidebar.appointment-history');
    }

    public function settings()
    {
        return view('lawyer.sidebar.settings');
    }
}
