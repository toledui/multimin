<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

    // Tickets
    Route::get('/dashboard/ticket/create', [TicketController::class, 'create'])->middleware(['auth', 'verified'])->name('ticket.create');
    Route::post('/dashboard/ticket', [TicketController::class, 'store'])->middleware(['auth', 'verified'])->name('ticket.store');

require __DIR__.'/auth.php';
