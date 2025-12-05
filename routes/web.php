<?php

use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\FeedbackController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

Route::get('/', [ProductsController::class, 'index'])->name('home');
Route::get('/products', [ProductsController::class, 'allProducts'])->name('products.index');
Route::get('/products/{id}', [ProductsController::class, 'show'])->name('products.show');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');
Route::get('/about', [AboutController::class, 'index'])->name('about');

// Cart Routes - Protected (requires login)
Route::middleware(['user.auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{key}', [CartController::class, 'remove'])->name('cart.remove')->where('key', '.*');
    
    // Checkout Routes
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/checkout/success/{orderId}', [CheckoutController::class, 'success'])->name('checkout.success');
});

// Admin Dashboard - Only admins can access
Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified', 'admin'])
    ->name('dashboard');

// Admin Product Management Routes
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/products', [\App\Http\Controllers\Admin\ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [\App\Http\Controllers\Admin\ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [\App\Http\Controllers\Admin\ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}/edit', [\App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [\App\Http\Controllers\Admin\ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [\App\Http\Controllers\Admin\ProductController::class, 'destroy'])->name('products.destroy');
    
    // Order Management Routes
    Route::get('/orders', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders/{id}/accept', [\App\Http\Controllers\Admin\OrderController::class, 'accept'])->name('orders.accept');
    Route::delete('/orders/{id}', [\App\Http\Controllers\Admin\OrderController::class, 'destroy'])->name('orders.destroy');
    
    // Customer Management Routes
    Route::get('/customers', [\App\Http\Controllers\Admin\CustomerController::class, 'index'])->name('customers.index');
    
    // User Management Routes
    Route::get('/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
    Route::post('/users/{id}/toggle-type', [\App\Http\Controllers\Admin\UserController::class, 'toggleType'])->name('users.toggleType');
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});
