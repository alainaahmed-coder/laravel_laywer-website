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
        return view('lawyer.myprofile');
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
        return view('lawyer.myclient');
    }

    public function appointmentHistory()
    {
        return view('lawyer.appointmenthistory');
    }

    public function settings()
    {
        return view('lawyer.setting');
    }
}
