<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class lawyerdashboardController extends Controller
{
    function lawyerdashboard()
    {
        return view('lawyer.dashboard');
    }
}
