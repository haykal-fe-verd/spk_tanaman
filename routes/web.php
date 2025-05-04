<?php

use App\Http\Controllers\AhpController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

// ahp
Route::get('ahp', [AhpController::class, 'index'])->name('ahp.index');
Route::post('ahp', [AhpController::class, 'store'])->name('ahp.store');
Route::post('/ahp/bobot', [AhpController::class, 'bobotAhp'])->name('ahp.bobot');


require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
