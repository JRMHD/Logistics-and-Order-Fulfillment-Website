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
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::view('/about', 'about');
Route::view('/contact', 'contact');
Route::view('/faq', 'faq');
Route::view('/footer', 'footer');
Route::view('/header', 'header');
Route::view('/order-tracking', 'order-tracking');
Route::view('/service-details', 'service-details');
Route::view('/services', 'services');

// 404 Page
Route::fallback(function () {
    return view('404');
});