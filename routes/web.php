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
use App\Http\Controllers\ApiKeyController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\ApiKeyController as AdminApiKeyController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

// User dashboard - requires authentication and email verification
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// User profile routes - requires authentication and email verification
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

// Public routes (no authentication required)
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

// Public form submissions (no verification required)
Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');
Route::post('/subscribe', [SubscriptionController::class, 'subscribe'])->name('subscribe');
Route::post('/quote-request', [QuoteRequestController::class, 'store'])->name('quote.request');

// Admin routes - requires authentication, email verification, and admin access
Route::middleware(['auth', 'verified', 'role:admin_access'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
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

// Admin-only routes (strict admin access) - requires authentication, email verification, and admin role
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    // Add routes that only admins should access
    // For example: user management, system settings, etc.
});

// Order tracking (public access)
Route::get('/order-tracking', [TruckingController::class, 'trackOrder'])->name('order.tracking');

// Payment routes (public access for customer payments)
Route::get('/trucking/payment/{id}', [TruckingPaymentController::class, 'showPaymentForm'])->name('admin.trucking.payment.form');
Route::post('/trucking/payment/process/{id}', [TruckingPaymentController::class, 'initiatePayment'])->name('admin.trucking.payment.process');
Route::post('/mpesa/callback', [MpesaCallbackController::class, 'handleCallback']);

// Payment callback and status routes (admin access)
Route::middleware(['auth', 'verified', 'role:admin_access'])->group(function () {
    Route::post('admin/trucking/payment/callback', [TruckingPaymentController::class, 'callback'])->name('admin.trucking.payment.callback');
    Route::get('admin/trucking/payment/status/{id}', [TruckingPaymentController::class, 'checkStatus'])->name('admin.trucking.payment.status');
});

// Blog management - requires authentication, email verification, and admin access
Route::prefix('admin')->middleware(['auth', 'verified', 'role:admin_access'])->group(function () {
    Route::resource('blogs', BlogController::class, [
        'names' => 'admin.blogs'
    ]);

    Route::get('/comments', [CommentController::class, 'index'])->name('admin.comments.index');
    Route::get('/comments/{comment}', [CommentController::class, 'show'])->name('admin.comments.show');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('admin.comments.destroy');
});

// Public blog routes
Route::get('/blog', [BlogController::class, 'publicIndex'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'publicShow'])->name('blog.show');

// SEO routes (public access)
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

// Public comment routes
Route::post('/comments', [BlogController::class, 'storeComment'])->name('comments.store');
Route::get('/comments/{blog_id}', [BlogController::class, 'fetchComments'])->name('comments.fetch');
Route::get('/', [BlogController::class, 'welcome'])->name('home');

// Country-specific service pages (public access)
// Kenya Routes
Route::get('/cashondelivery/kenya', function () {
    return view('cashondelivery.kenya');
});

// Tanzania Routes
Route::get('/cashondelivery/tanzania', function () {
    return view('cashondelivery.Tanzania');
});

// Uganda Routes
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



Route::middleware(['auth', 'verified', 'role:admin_access'])->group(function () {

    // User Management
    Route::resource('/admin/users', \App\Http\Controllers\Admin\UserManagementController::class)->names('admin.users');
    Route::patch('/admin/users/{user}/freeze', [\App\Http\Controllers\Admin\UserManagementController::class, 'toggleFreeze'])->name('admin.users.freeze');
    Route::patch('/admin/users/{user}/password', [\App\Http\Controllers\Admin\UserManagementController::class, 'updatePassword'])->name('admin.users.password');
    Route::patch('/admin/users/{user}/api-authorization', [\App\Http\Controllers\Admin\UserManagementController::class, 'toggleApiAuthorization'])->name('admin.users.api-authorization');
});


Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('api-keys', ApiKeyController::class);
    Route::patch('/api-keys/{apiKey}/regenerate', [ApiKeyController::class, 'regenerate'])->name('api-keys.regenerate');
    Route::patch('/api-keys/{apiKey}/toggle', [ApiKeyController::class, 'toggle'])->name('api-keys.toggle');

    // User Order Management Routes
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
});

// Admin Order Management
Route::middleware(['auth', 'verified', 'role:admin_access'])->group(function () {
    Route::prefix('admin/orders')->name('admin.orders.')->group(function () {
        Route::get('/', [AdminOrderController::class, 'index'])->name('index');
        Route::get('/dashboard', [AdminOrderController::class, 'dashboard'])->name('dashboard');
        Route::get('/{order}', [AdminOrderController::class, 'show'])->name('show');
        Route::get('/{order}/edit', [AdminOrderController::class, 'edit'])->name('edit');
        Route::put('/{order}', [AdminOrderController::class, 'update'])->name('update');
        Route::patch('/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('update-status');
        Route::post('/bulk-status-update', [AdminOrderController::class, 'bulkStatusUpdate'])->name('bulk-status-update');
        Route::delete('/{order}', [AdminOrderController::class, 'destroy'])->name('destroy');
        Route::get('/export/csv', [AdminOrderController::class, 'export'])->name('export');
    });

    // Admin API Key Management Routes
    Route::prefix('admin/api-keys')->name('admin.api-keys.')->group(function () {
        Route::get('/', [AdminApiKeyController::class, 'index'])->name('index');
        Route::get('/{apiKey}', [AdminApiKeyController::class, 'show'])->name('show');
        Route::get('/{apiKey}/usage', [AdminApiKeyController::class, 'usage'])->name('usage');
        Route::patch('/{apiKey}/toggle', [AdminApiKeyController::class, 'toggle'])->name('toggle');
        Route::delete('/{apiKey}', [AdminApiKeyController::class, 'destroy'])->name('destroy');
        Route::post('/bulk-action', [AdminApiKeyController::class, 'bulkAction'])->name('bulk-action');
    });
});

// Public API Documentation
Route::get('/api-docs', function () {
    return view('api-documentation');
})->name('api.documentation');
