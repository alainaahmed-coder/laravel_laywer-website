<?php

use App\Http\Controllers\admindashboardController;
use App\Http\Controllers\AdminSidebarController;
use App\Http\Controllers\customerdashboardController;
use App\Http\Controllers\CustomerSidebarController;
use App\Http\Controllers\landingpageController;
use App\Http\Controllers\lawyerdashboardController;
use App\Http\Controllers\LawyerSidebarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Public Pages
Route::get('/', [landingpageController::class, 'index'])->name('Home');
Route::get('/FindLawyer', [landingpageController::class, 'findLawyer'])->name('lawyerfind');
Route::get('/lawyer/profile/{id}', [landingpageController::class, 'lawyerProfile'])->name('lawyer.profile');
Route::get('/About', [landingpageController::class, 'about'])->name('about');
Route::get('/contact', [landingpageController::class, 'contact'])->name('contact');
Route::post('/contact/send', [landingpageController::class, 'contactSend'])->name('contact.send');

// Main Dashboard Redirection
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

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Dashboard
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin-dashboard', [admindashboardController::class, 'admindashboard'])->name('admindashboard');
});

// Customer Dashboard
Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/customer-dashboard', [customerdashboardController::class, 'customerdashboard'])->name('customerdashboard');
});

// Lawyer Dashboard
Route::middleware(['auth', 'role:lawyer'])->group(function () {
    Route::get('/lawyer-dashboard', [lawyerdashboardController::class, 'lawyerdashboard'])->name('lawyerdashboard');
});

// Lawyer Sidebar Routes
// Lawyer Sidebar Routes
Route::prefix('lawyer')->name('lawyer.')->group(function () {

    Route::get('/profile', [LawyerSidebarController::class, 'profile'])
        ->name('profiles');

    Route::post('/profile/update', [LawyerSidebarController::class, 'updateProfile'])
        ->name('profile.update');

    Route::get('/services', [LawyerSidebarController::class, 'services'])
        ->name('services');

    Route::get('/schedule', [LawyerSidebarController::class, 'schedule'])
        ->name('schedule');

    Route::post('/schedule', [LawyerSidebarController::class, 'storeSchedule'])
        ->name('schedule.store');

    Route::put('/schedule/{id}', [LawyerSidebarController::class, 'updateSchedule'])
        ->name('schedule.update');

    Route::delete('/schedule/{id}', [LawyerSidebarController::class, 'deleteSchedule'])
        ->name('schedule.delete');

    Route::get('/clients', [LawyerSidebarController::class, 'clients'])
        ->name('clients');

    Route::get('/appointment-history', [LawyerSidebarController::class, 'appointmentHistory'])
        ->name('appointment.history');

    Route::get('/settings', [LawyerSidebarController::class, 'settings'])
        ->name('settings');
});

// Admin Sidebar Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/Dashboard', [AdminSidebarController::class, 'dashboard'])->name('dashboard');
    Route::get('/customers', [AdminSidebarController::class, 'customers'])->name('customers');
    Route::get('/cities', [AdminSidebarController::class, 'cities'])->name('cities');
    Route::get('/services', [AdminSidebarController::class, 'services'])->name('services');

    // Updated Lawyer Management route
    Route::get('/lawyers', [admindashboardController::class, 'lawyerList'])->name('lawyers');
    Route::get('/appointments', [AdminSidebarController::class, 'appointments'])->name('appointments');
    Route::get('/website-content', [AdminSidebarController::class, 'websiteContent'])->name('website.content');
    Route::get('/settings', [AdminSidebarController::class, 'settings'])->name('settings');
});

// Customer Sidebar Routes
Route::prefix('customer')->name('customer.')->group(function () {
    Route::get('/overview', [CustomerSidebarController::class, 'overview'])->name('overview');
    Route::get('/find-lawyer', [CustomerSidebarController::class, 'findLawyer'])->name('find.lawyer');
    Route::get('/my-appointments', [CustomerSidebarController::class, 'myAppointments'])->name('my.appointments');
    Route::get('/my-profile', [CustomerSidebarController::class, 'myProfile'])->name('my.profile');
    Route::get('/profile-settings', [CustomerSidebarController::class, 'profileSettings'])->name('profile.settings');
});

Route::prefix('admin')->group(function () {
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
    Route::put('/customers/{id}', [CustomerController::class, 'update'])->name('customers.update');
    Route::delete('/customers/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');

    /////////// Lawyer Management Actions ///////////////////
    Route::post('/lawyers/toggle/{id}', [admindashboardController::class, 'toggleLawyerStatus'])->name('admin.lawyers.toggle');
    Route::delete('/lawyers/{id}', [admindashboardController::class, 'deleteLawyer'])->name('admin.lawyers.delete');

    /////////// Add Services ///////////////////
    Route::post('/ServicesPost', [admindashboardController::class, 'serviceStore'])->name('customers.Servcies');
    Route::put('/Services/{id}', [admindashboardController::class, 'updateService'])->name('customers.updateService');
    Route::delete('/Services/{id}', [admindashboardController::class, 'deleteService'])->name('customers.deleteService');

    /////////// Cities Routes //////////////////
    Route::post('/CitiesPost', [admindashboardController::class, 'citieStore'])->name('customers.citieStore');
    Route::put('/Citiesupdate/{id}', [admindashboardController::class, 'updateCities'])->name('customers.updateCities');
    Route::delete('/CitiesDelete/{id}', [admindashboardController::class, 'deleteCities'])->name('customers.deleteCities');
});

require __DIR__ . '/auth.php';
