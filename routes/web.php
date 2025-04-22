<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/users', function () {
    return view('users.index');
})->middleware(['auth', 'verified'])->name('users');

Route::get('/events', function () {
    return view('events.index');
})->middleware(['auth', 'verified'])->name('events');

Route::get('/application', function () {
    return view('application.index');
})->middleware(['auth', 'verified'])->name('application');

Route::get('/review', function () {
    return view('review.index');
})->middleware(['auth', 'verified'])->name('review');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
