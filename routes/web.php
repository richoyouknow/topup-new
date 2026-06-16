<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminFaqController;
use App\Http\Controllers\Admin\AdminTestimonialController;
use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\Admin\AdminCategoryController;


// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/categories/{slug}', [ProductController::class, 'showCategory'])->name('categories.show');
Route::post('/categories/{slug}/checkout', [ProductController::class, 'checkout'])->name('categories.checkout');
Route::get('/orders/{id}/payment', [ProductController::class, 'payment'])->name('orders.payment');
Route::post('/orders/{id}/payment', [ProductController::class, 'uploadPayment'])->name('orders.upload_payment');

// Admin Auth Routes
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Panel Routes (Protected by Auth)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Product CRUD
    Route::resource('products', AdminProductController::class)->except(['show']);
    Route::delete('products/{product}/image', [AdminProductController::class, 'deleteImage'])->name('products.image.delete');

    // Category CRUD
    Route::resource('categories', AdminCategoryController::class)->except(['show']);
    Route::delete('categories/{category}/image', [AdminCategoryController::class, 'deleteImage'])->name('categories.image.delete');
        
    // Order Management
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.status');
    Route::delete('/orders/{order}', [AdminOrderController::class, 'destroy'])->name('orders.destroy');
    
    // FAQ CRUD
    Route::resource('faqs', AdminFaqController::class)->except(['show']);
    
    // Testimonial CRUD
    Route::resource('testimonials', AdminTestimonialController::class)->except(['show']);
    
    // Settings
    Route::get('/settings', [AdminSettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [AdminSettingController::class, 'update'])->name('settings.update');
});
