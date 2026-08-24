<?php

use App\Http\Controllers\admindashboardController;
use App\Http\Controllers\customerdashboardController;
use App\Http\Controllers\landingpageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminSidebarController;
use App\Http\Controllers\lawyerdashboardController;
use App\Http\Controllers\LawyerSidebarController;
use App\Http\Controllers\CustomerSidebarController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('Home');
Route::get('/FindLawyer', [landingpageController::class, 'findLawyer'])
    ->name('lawyerfind');

Route::get('/About', [landingpageController::class, 'about'])
    ->name('about');
Route::get('/contact', [landingpageController::class, 'contact'])
    ->name('contact');

Route::get('/dashboard', function () {
    $user = Auth::user();

  if ($user->role === 'admin') {
        return redirect()->route('admindashboard');
    }

    if ($user->role === 'lawyer') {
        return redirect()->route('lawyerdashboard');
    }

    if ($user->role === 'customer') {
        return redirect()->route('customerdashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

// Admin Dashboard
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin-dashboard', [admindashboardController::class, 'admindashboard'])
        ->name('admindashboard');
});

// Customer Dashboard
Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/customer-dashboard', [customerdashboardController::class, 'customerdashboard'])
        ->name('customerdashboard');
});

// Lawyer Dashboard
Route::middleware(['auth', 'role:lawyer'])->group(function () {
    Route::get('/lawyer-dashboard', [lawyerdashboardController::class, 'lawyerdashboard'])
        ->name('lawyerdashboard');
});

require __DIR__.'/auth.php';



//Laywer Dahsbaord side bar links



Route::prefix('lawyer')->name('lawyer.')->group(function () {
    Route::get('/overview', [LawyerSidebarController::class, 'overview'])->name('overview');
    Route::get('/profile', [LawyerSidebarController::class, 'profile'])->name('profile');
    Route::get('/services', [LawyerSidebarController::class, 'services'])->name('services');
    Route::get('/schedule', [LawyerSidebarController::class, 'schedule'])->name('schedule');
    Route::get('/clients', [LawyerSidebarController::class, 'clients'])->name('clients');
    Route::get('/appointment-history', [LawyerSidebarController::class, 'appointmentHistory'])->name('appointment.history');
    Route::get('/settings', [LawyerSidebarController::class, 'settings'])->name('settings');
});


//Admin dashbaord side bar routes



Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/approvals', [AdminSidebarController::class, 'approvals'])->name('approvals');
    Route::get('/customers', [AdminSidebarController::class, 'customers'])->name('customers');
    Route::get('/cities', [AdminSidebarController::class, 'cities'])->name('cities');
    Route::get('/services', [AdminSidebarController::class, 'services'])->name('services');
    Route::get('/schedules', [AdminSidebarController::class, 'schedules'])->name('schedules');
    Route::get('/appointments', [AdminSidebarController::class, 'appointments'])->name('appointments');
    Route::get('/website-content', [AdminSidebarController::class, 'websiteContent'])->name('website.content');
    Route::get('/settings', [AdminSidebarController::class, 'settings'])->name('settings');
});


//customer sidebar routes



Route::prefix('customer')->name('customer.')->group(function () {
    Route::get('/overview', [CustomerSidebarController::class, 'overview'])->name('overview');
    Route::get('/find-lawyer', [CustomerSidebarController::class, 'findLawyer'])->name('find.lawyer');
    Route::get('/my-appointments', [CustomerSidebarController::class, 'myAppointments'])->name('my.appointments');
    Route::get('/my-profile', [CustomerSidebarController::class, 'myProfile'])->name('my.profile');
    Route::get('/profile-settings', [CustomerSidebarController::class, 'profileSettings'])->name('profile.settings');
});
