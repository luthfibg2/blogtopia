<?php

use App\Http\Middleware\CheckLicenseExpiration;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContentController;

Route::middleware([CheckLicenseExpiration::class])->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.login');

    Route::get('/signup', [AuthController::class, 'signup'])->name('signup');
    Route::post('/signup', [AuthController::class, 'store'])->name('auth.signup');

    Route::get('/', [ContentController::class, 'home'])->name('home');
    Route::get('/{category}', [ContentController::class, 'category'])->name('content.index');
    Route::get('/{category}/{type}', [ContentController::class, 'index'])->name('content.type');
    Route::middleware(['auth'])->group(function () {

        Route::get('/all', [HomeController::class, 'index'])->name('home');

        Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

        Route::get('/{category}/{type}/create', [ContentController::class, 'create'])->name('content.create');
        Route::post('/{category}/{type}/post', [ContentController::class, 'store'])->name('content.store');

        Route::get('/{category}/{type}/{slug}/edit', [ContentController::class, 'edit'])->name('content.edit');
        Route::put('/{category}/{type}/{slug}/save-changes', [ContentController::class, 'update'])->name('content.save');
    });

    Route::get('/{category}/{type}/{slug}', [ContentController::class, 'show'])->name('content.read');
});

Route::get('exp', function () {
    return view('pages.index');
})->name('pages.index');