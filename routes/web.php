<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductionController;
use App\Http\Controllers\SupervisorController;

Route::get('/', function () {
    return view('welcome');
})->middleware('auth');

// Auth
Route::get('login', [AuthController::class,'showLogin'])->name('login');
Route::post('login', [AuthController::class,'login']);
Route::post('logout', [AuthController::class,'logout'])->name('logout')->middleware('auth');

// Operator
Route::middleware(['auth','role:operator'])->group(function(){
    Route::get('operator/form', [ProductionController::class,'create'])->name('operator.form');
    Route::post('productions', [ProductionController::class,'store'])->name('productions.store');
    Route::get('productions/{production}/edit', [ProductionController::class,'edit'])->name('productions.edit');
    Route::put('productions/{production}', [ProductionController::class,'update'])->name('productions.update');
});

// Supervisor
Route::middleware(['auth','role:supervisor'])->group(function(){
    Route::get('supervisor/dashboard', [SupervisorController::class,'dashboard'])->name('supervisor.dashboard');
    Route::post('productions/{production}/validate', [SupervisorController::class,'validate'])->name('productions.validate');
});

// Admin
Route::middleware(['auth','role:admin'])->prefix('admin')->name('admin.')->group(function(){
    Route::get('/', function(){ return redirect()->route('admin.users.index'); })->name('home');
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->names('users');
    Route::post('users/{user}/reset-password', [\App\Http\Controllers\Admin\UserController::class,'resetPassword'])->name('users.reset');

    // Product management
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class)->except(['show']);

    // Shifts
    Route::resource('shifts', \App\Http\Controllers\Admin\ShiftController::class)->except(['show']);
});
