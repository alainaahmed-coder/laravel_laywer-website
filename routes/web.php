<?php

use App\Http\Controllers\admi\dashbaordController;
use App\Http\Controllers\admindashboardController;
use App\Http\Controllers\customerdashboardController;
use App\Http\Controllers\lawyerdashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view ('welcome');
});


Route::get('/admin-dashboard',[admindashboardController::class, 'admindashboard']);

Route::get('/customer-dashboard',[customerdashboardController::class, 'customerdashboard']);

Route::get('/lawyer-dashboard',[lawyerdashboardController::class, 'lawyerdashboard']);
