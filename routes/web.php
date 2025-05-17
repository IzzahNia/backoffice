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

Route::get('/applications', function () {
    return view('application.index');
})->middleware(['auth', 'verified'])->name('applications');

Route::get('/reviews', function () {
    return view('review.index');
})->middleware(['auth', 'verified'])->name('reviews');

Route::get('/apply/{type}', \App\Livewire\ApplicationForm::class)->middleware(['auth', 'verified'])->name('apply');

Route::get('/review/{application}', \App\Livewire\ReviewApplication::class)->middleware(['auth', 'verified'])->name('viewApplication');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('v2')->group(function () {
    Route::get('/users', function () {
        return view('v2.users.index');
    })->middleware(['auth', 'verified'])->name('v2.users');
    Route::get('/events', function () {
        return view('v2.events.index');
    })->middleware(['auth', 'verified'])->name('v2.events');
    Route::get('/applications', function () {
        return view('v2.applications.index');
    })->middleware(['auth', 'verified'])->name('v2.applications');
    Route::get('/reviews', function () {
        return view('v2.applicationReviews.index');
    })->middleware(['auth', 'verified'])->name('v2.reviews');
});

Route::get('/applications/{application}', [App\Http\Controllers\ApplicationDetailsController::class, 'show'])->name('applications.details');

require __DIR__.'/auth.php';
