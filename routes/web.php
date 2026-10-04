<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

// Public Website Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Company Info & About Us
Route::get('/tentang-kami', [CompanyController::class, 'about'])->name('about');
Route::get('/tim', [CompanyController::class, 'team'])->name('team');
Route::get('/galeri', [CompanyController::class, 'gallery'])->name('galeri');
Route::get('/gallery', [CompanyController::class, 'gallery'])->name('gallery');
Route::get('/portofolio', [CompanyController::class, 'portfolio'])->name('portfolio');
Route::get('/portofolio/{slug}', [CompanyController::class, 'portfolioDetail'])->name('portfolio.detail');
Route::get('/testimoni', [CompanyController::class, 'testimonials'])->name('testimonials');

// Services & Products
Route::get('/layanan', [ServiceController::class, 'index'])->name('services');
Route::get('/layanan/{slug}', [ServiceController::class, 'show'])->name('services.show');
Route::get('/produk', [ProductController::class, 'index'])->name('products');
Route::get('/produk/{slug}', [ProductController::class, 'show'])->name('products.show');

// Contact Us
Route::get('/kontak', [ContactController::class, 'index'])->name('contact');
Route::post('/kontak', [ContactController::class, 'store'])->name('contact.store');

// Admin Authentication Routes (public - no middleware)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Admin Back-Office Panel (protected by AdminAuth middleware)
Route::prefix('admin')->name('admin.')->middleware('admin.auth')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

    // Services
    Route::get('/services', [AdminController::class, 'services'])->name('services');
    Route::post('/services/store', [AdminController::class, 'serviceStore'])->name('services.store');
    Route::delete('/services/{id}', [AdminController::class, 'serviceDelete'])->name('services.delete');

    // Products
    Route::get('/products', [AdminController::class, 'products'])->name('products');
    Route::post('/products/store', [AdminController::class, 'productStore'])->name('products.store');
    Route::delete('/products/{id}', [AdminController::class, 'productDelete'])->name('products.delete');

    // Team Members
    Route::get('/team', [AdminController::class, 'team'])->name('team');
    Route::post('/team/store', [AdminController::class, 'teamStore'])->name('team.store');
    Route::delete('/team/{id}', [AdminController::class, 'teamDelete'])->name('team.delete');

    // Gallery
    Route::get('/gallery', [AdminController::class, 'gallery'])->name('gallery');
    Route::post('/gallery/store', [AdminController::class, 'galleryStore'])->name('gallery.store');
    Route::delete('/gallery/{id}', [AdminController::class, 'galleryDelete'])->name('gallery.delete');

    // Portfolios
    Route::get('/portfolios', [AdminController::class, 'portfolios'])->name('portfolios');
    Route::post('/portfolios/store', [AdminController::class, 'portfolioStore'])->name('portfolios.store');
    Route::delete('/portfolios/{id}', [AdminController::class, 'portfolioDelete'])->name('portfolios.delete');

    // Testimonials
    Route::get('/testimonials', [AdminController::class, 'testimonials'])->name('testimonials');
    Route::post('/testimonials/store', [AdminController::class, 'testimonialStore'])->name('testimonials.store');
    Route::delete('/testimonials/{id}', [AdminController::class, 'testimonialDelete'])->name('testimonials.delete');

    // Messages / RFQ Inbox
    Route::get('/messages', [AdminController::class, 'messages'])->name('messages');
    Route::post('/messages/toggle/{id}', [AdminController::class, 'messageToggleRead'])->name('messages.toggle');
    Route::delete('/messages/{id}', [AdminController::class, 'messageDelete'])->name('messages.delete');

    // Website Settings
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
    Route::post('/settings/update', [AdminController::class, 'settingsUpdate'])->name('settings.update');
});
