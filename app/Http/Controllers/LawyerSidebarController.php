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
        return view('lawyer.myservices');
    }

    public function schedule()
    {
        return view('lawyer.mysechedule');
    }

    public function clients()
    {
        return view('lawyer.myclients');
    }

    public function appointmentHistory()
    {
        return view('lawyer.appointmenthistory');
    }

    public function settings()
    {
        return view('lawyer.settings');
    }
}
