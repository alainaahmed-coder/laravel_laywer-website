<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class admindashboardController extends Controller
{
    function admindashboard(){
        return view ('admin.dashboard');
    }
}
