<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');

    Route::resource('properties', PropertyController::class);
    Route::resource('properties.units', UnitController::class);   // nested
    Route::resource('tenants', TenantController::class);
    Route::resource('leases', LeaseController::class);
});

require __DIR__.'/auth.php';
