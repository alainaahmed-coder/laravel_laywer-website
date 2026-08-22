<?php

use App\Http\Controllers\admindashboardController;
use App\Http\Controllers\customerdashboardController;
use App\Http\Controllers\landingpageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('Home');
Route::get('/FindLawyer',[landingpageController::class,'findLawyer'])->name('lawyerfind');
Route::get('/lawyerProfile', [landingpageController::class, 'lawyerProfile'])->name('lawyerProfile');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
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

Route::middleware(['auth', 'role:lawyer'])->group(function () {
    // Lawyer routes
});



require __DIR__.'/auth.php';
