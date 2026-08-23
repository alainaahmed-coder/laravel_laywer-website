<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class landingpageController extends Controller
{
    function findLawyer(){
        return view('findLawyer');
    }
    function about(){
        return view('about');
    }
    function  contact(){
        return view('contact');
    }
    
}
