<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class landingpageController extends Controller
{
    function findLawyer(){
        return view('findLawyer');
    }
    
    
}
