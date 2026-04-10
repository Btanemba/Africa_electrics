<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\OrderTrackingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/projects', function () {
    return view('projects.index');
})->name('projects.index');

Route::get('/company/team', function () {
    $teamMembers = \App\Models\TeamMember::where('is_active', true)
        ->orderBy('sort_order')
        ->get();
    return view('company.team', compact('teamMembers'));
})->name('team');

Route::get('/company/jobs', [JobController::class, 'index'])->name('jobs');
Route::get('/company/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');
Route::post('/company/jobs/{job}/apply', [JobController::class, 'apply'])->name('jobs.apply');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/category/{category}', [ProductController::class, 'byCategory'])->name('products.category');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/update/{product}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');

// Checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/order/confirmation/{orderNumber}', [CheckoutController::class, 'confirmation'])->name('order.confirmation');

// Order Tracking
Route::get('/track-order', [OrderTrackingController::class, 'index'])->name('track-order');
Route::post('/track-order', [OrderTrackingController::class, 'track'])->name('track-order.search');

// Override Backpack register routes with custom controller
Route::group([
    'middleware' => config('backpack.base.web_middleware', 'web'),
    'prefix' => config('backpack.base.route_prefix'),
], function () {
    Route::get('register', [\App\Http\Controllers\Admin\Auth\RegisterController::class, 'showRegistrationForm'])->name('backpack.auth.register');
    Route::post('register', [\App\Http\Controllers\Admin\Auth\RegisterController::class, 'register']);
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
