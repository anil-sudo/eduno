<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PageController;
use App\Http\Controllers\ContactController;

Route::name('eduno.')->group(function () {
    Route::get('/', [PageController::class, 'home'])->name('home');
    Route::get('about', [PageController::class, 'about'])->name('about');

    Route::prefix('contact')->name('contact.')->group(function () {
        Route::get('/', [ContactController::class, 'create'])->name('index');
        Route::post('store', [ContactController::class, 'store'])->name('store');
    });
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

require __DIR__.'/settings.php';
