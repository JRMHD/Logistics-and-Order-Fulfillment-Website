<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\TruckingController;
use App\Http\Controllers\Admin\AdminSubscriberController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\QuoteRequestController;
use App\Http\Controllers\Admin\TruckingPaymentController;
use App\Http\Controllers\MpesaCallbackController;


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

require __DIR__ . '/auth.php';


Route::view('/about', 'about');
Route::view('/contact', 'contact');
Route::view('/faq', 'faq');
Route::view('/footer', 'footer');
Route::view('/header', 'header');
Route::view('/order-tracking', 'order-tracking');
Route::view('/privacypolicy', 'privacypolicy');
Route::view('/termsandconditions', 'termsandconditions');
Route::view('/pricing', 'pricing');
Route::view('/services', 'services');
Route::view('/Quoterequest', 'Quoterequest');
Route::view('/courieranddelivery', 'courieranddelivery');
Route::view('/ecommercepackaging', 'ecommercepackaging');
Route::view('/warehousing', 'warehousing');
Route::view('/medicalcourier', 'medicalcourier');
Route::view('/bulklogistics', 'bulklogistics');
Route::view('/reverselogistics', 'reverselogistics');

// 404 Page
Route::fallback(function () {
    return view('404');
});

Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');
Route::post('/subscribe', [SubscriptionController::class, 'subscribe'])->name('subscribe');



Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    // Route::resource('/admin/trucking', TruckingController::class);
    Route::resource('/admin/trucking', TruckingController::class)->names('admin.trucking');

    // Subscriber Management
    Route::get('/admin/subscribers', [AdminSubscriberController::class, 'index'])->name('admin.subscribers.index');
    Route::get('/admin/subscribers/export', [AdminSubscriberController::class, 'exportCsv'])->name('admin.subscribers.export');

    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('admin/trucking/{id}/payment', [TruckingPaymentController::class, 'showPaymentForm'])->name('admin.trucking.payment');
    Route::post('admin/trucking/{id}/payment', [TruckingPaymentController::class, 'initiatePayment'])->name('admin.trucking.payment.process');
    Route::get('/trucking/payment/{id}', [TruckingPaymentController::class, 'showPaymentForm'])->name('admin.trucking.payment.form');
    Route::post('/trucking/payment/process/{id}', [TruckingPaymentController::class, 'initiatePayment'])->name('admin.trucking.payment.process');
});


Route::get('/order-tracking', [TruckingController::class, 'trackOrder'])->name('order.tracking');
Route::post('/quote-request', [QuoteRequestController::class, 'store'])->name('quote.request');

Route::get('/trucking/payment/{id}', [TruckingPaymentController::class, 'showPaymentForm'])->name('admin.trucking.payment.form');
Route::post('/trucking/payment/process/{id}', [TruckingPaymentController::class, 'initiatePayment'])->name('admin.trucking.payment.process');
Route::post('/mpesa/callback', [MpesaCallbackController::class, 'handleCallback']);