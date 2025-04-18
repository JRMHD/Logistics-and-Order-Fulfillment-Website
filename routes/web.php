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
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use Spatie\Sitemap\SitemapGenerator;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use App\Models\Blog;

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

Route::post('admin/trucking/payment/callback', [TruckingPaymentController::class, 'callback'])->name('admin.trucking.payment.callback');
Route::get('admin/trucking/payment/status/{id}', [TruckingPaymentController::class, 'checkStatus'])->name('admin.trucking.payment.status');

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::resource('blogs', BlogController::class, [
        'names' => 'admin.blogs'
    ]);

    Route::get('/comments', [CommentController::class, 'index'])->name('admin.comments.index');
    Route::get('/comments/{comment}', [CommentController::class, 'show'])->name('admin.comments.show');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('admin.comments.destroy');
});

Route::get('/blog', [BlogController::class, 'publicIndex'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'publicShow'])->name('blog.show');

Route::get('/sitemap.xml', function () {
    SitemapGenerator::create(config('app.url'))->writeToFile(public_path('sitemap.xml'));
    return response()->file(public_path('sitemap.xml'));
});
Route::get('/sitemap.xml', function () {
    return response()->view('sitemap')->header('Content-Type', 'text/xml');
});
Route::get('/robots.txt', function () {
    return response()->view('robots')->header('Content-Type', 'text/plain');
});
Route::get('/sitemap.xml', function () {
    $urls = [
        url('/'),
        url('/about'),
        url('/courieranddelivery'),
        url('/ecommercepackaging'),
        url('/warehousing'),
        url('/medicalcourier'),
        url('/bulklogistics'),
        url('/reverselogistics'),
        url('/contact'),
    ];

    // Add dynamic blog URLs
    $blogs = Blog::latest()->get();
    foreach ($blogs as $blog) {
        $urls[] = url('/blog/' . $blog->id);
    }

    $content = view('sitemap', compact('urls'))->render();

    return response($content)->header('Content-Type', 'application/xml');
});


Route::post('/comments', [BlogController::class, 'storeComment'])->name('comments.store');
Route::get('/comments/{blog_id}', [BlogController::class, 'fetchComments'])->name('comments.fetch');
Route::get('/', [BlogController::class, 'welcome'])->name('home');


// Route::prefix('{country}')->group(function () {
//     Route::view('/courieranddelivery', 'courieranddelivery');
//     Route::view('/ecommercepackaging', 'ecommercepackaging');
//     Route::view('/warehousing', 'warehousing');
//     Route::view('/medicalcourier', 'medicalcourier');
//     Route::view('/bulklogistics', 'bulklogistics');
//     Route::view('/reverselogistics', 'reverselogistics');
// });


// Kenya Route
Route::get('/cashondelivery/kenya', function () {
    return view('cashondelivery.kenya');
});

// Tanzania Route
Route::get('/cashondelivery/tanzania', function () {
    return view('cashondelivery.Tanzania');
});

// Uganda Route
Route::get('/cashondelivery/uganda', function () {
    return view('cashondelivery.Uganda');
});

Route::get('/courieranddeliveryservices/kenya', function () {
    return view('courieranddeliveryservices.kenya');
});

Route::get('/courieranddeliveryservices/tanzania', function () {
    return view('courieranddeliveryservices.tanzania');
});

Route::get('/courieranddeliveryservices/uganda', function () {
    return view('courieranddeliveryservices.uganda');
});

Route::get('/medicalcourier/kenya', function () {
    return view('medicalcourier.kenya');
});

Route::get('/medicalcourier/tanzania', function () {
    return view('medicalcourier.tanzania');
});

Route::get('/medicalcourier/uganda', function () {
    return view('medicalcourier.uganda');
});
Route::get('/orderfulfilment/kenya', function () {
    return view('orderfulfilment.kenya');
});

Route::get('/orderfulfilment/tanzania', function () {
    return view('orderfulfilment.tanzania');
});

Route::get('/orderfulfilment/uganda', function () {
    return view('orderfulfilment.uganda');
});

Route::get('/reverselogistics/kenya', function () {
    return view('reverselogistics.kenya');
});

Route::get('/reverselogistics/tanzania', function () {
    return view('reverselogistics.tanzania');
});

Route::get('/reverselogistics/uganda', function () {
    return view('reverselogistics.uganda');
});

Route::get('/warehousingandstorage/kenya', function () {
    return view('warehousingandstorage.kenya');
});

Route::get('/warehousingandstorage/tanzania', function () {
    return view('warehousingandstorage.tanzania');
});

Route::get('/warehousingandstorage/uganda', function () {
    return view('warehousingandstorage.uganda');
});
