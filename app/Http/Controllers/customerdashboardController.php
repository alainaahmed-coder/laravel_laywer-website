<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class customerdashboardController extends Controller
{
         function customerdashboard(){
        return view ('customer.dashboard');
    }
}
