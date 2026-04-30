<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\OrderTrackingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Models\Project;
use App\Models\Service;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $services = Service::visible()->ordered()->get();
    $projects = Project::with('images')->visible()->ordered()->limit(6)->get();

    return view('home', compact('services', 'projects'));
});

Route::get('/projects', function () {
    $projects = Project::with('images')->visible()->ordered()->get();

    return view('projects.index', compact('projects'));
})->name('projects.index');

Route::view('/faq', 'faq')->name('faq');
Route::view('/privacy-policy', 'privacy-policy')->name('privacy-policy');
Route::view('/terms-of-service', 'terms-of-service')->name('terms-of-service');

Route::get('/projects/{project}', function (Project $project) {
    abort_unless($project->is_active, 404);
    $project->loadMissing('images');

    return view('projects.show', compact('project'));
})->name('projects.show');

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
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

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
