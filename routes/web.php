<?php

use App\Http\Controllers\admi\dashbaordController;
use App\Http\Controllers\admindashboardController;
use App\Http\Controllers\customerdashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view ('welcome');
});


Route::get('/admin-dashboard',[admindashboardController::class, 'admindashboard']);

Route::get('/customer-dashboard',[customerdashboardController::class, 'customerdashboard']);
