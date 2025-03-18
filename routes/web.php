<?php
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ContactUsController as AdminContactUsController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ProductController as UserProductController;
use App\Http\Controllers\ContactUsController as UserContactUsController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
// Home Route
Route::get('/', [HomeController::class, 'index'])->name('home');

// Switch languages route

Route::get('/lang/{locale}', [LocalizationController::class, 'switchLang'])->name('locale.switch');

// User routes
Route::get('/product-details/{slug}', [UserProductController::class, 'show'])->name('products.show');
Route::get('/contact-us', [UserContactUsController::class, 'index'])->name('contactUs.index');
Route::post('/contact-us', [UserContactUsController::class, 'send'])->name('contactUs.send');

// User redirect without data
Route::get('/privacy-policy', [PageController::class, 'privacyPolicy'])->name('privacy.policy');
Route::get('/terms-of-service', [PageController::class, 'termsService'])->name('terms.service');
Route::get('/about-us', [PageController::class, 'aboutUs'])->name('about.us');
Route::get('/gallery', [PageController::class, 'gallery'])->name('gallery');
Route::get('/branches', [PageController::class, 'branches'])->name('branches');

// User fetch products
Route::get('/products', [UserProductController::class, 'index'])->name('products.index');
Route::get('/products/data', [UserProductController::class, 'productData'])->name('products.data');

// User fetch cart
Route::controller(CartController::class)->group(function () {
    Route::get('/cart', 'index');
    Route::post('/cart/add/{id}', 'add');
    Route::post('/cart/update', 'update');
    Route::post('/cart/remove', 'remove');
    Route::post('/cart/clear', 'clear');
});

// Admin Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::prefix('admin')->name('admin.')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    // Protected Admin Routes
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('categories', CategoryController::class);
        Route::resource('products', ProductController::class);
        Route::post('products/{product}/upload-image', [ProductController::class, 'uploadImage'])->name('products.uploadImage');
        Route::delete('products/remove-image/{id}', [ProductController::class, 'removeImage'])->name('products.removeImage');

        Route::get('products/{id}/images', [ProductController::class, 'getProductImages'])->name('products.getImages');
        Route::resource('blogs', BlogController::class);
        Route::resource('contact_us', AdminContactUsController::class);
        Route::resource('users', UserController::class);

    });
});


// Shop routes
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/product/{slug}', [ShopController::class, 'show'])->name('product.show');


Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');
Route::post('/checkout', [CheckoutController::class, 'submit'])->name('checkout.submit');


Route::post('/admin/products', [ProductController::class, 'store'])->name('admin.products.store');
