<?php
use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ContactUsController as AdminContactUsController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AreaController as UserAreaController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController as UserProductController;
use App\Http\Controllers\ContactUsController as UserContactUsController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
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
Route::controller(CartController::class)->prefix('cart')->group(function () {
    Route::get('/', 'index')->name('cart.index');
    Route::post('/add/{id}', 'add')->name('cart.add');
    Route::post('/update', 'update')->name('cart.update');
    Route::delete('/remove/{key}', 'delete')->name('cart.remove');
    Route::post('/clear', 'clear')->name('cart.clear');
    Route::get('/countItem', 'countItem')->name('cart.countItem');
    Route::get('/checkout', 'checkout')->name('cart.checkout');
});


// User fetch orders
Route::controller(OrderController::class)->prefix('orders')->group(function () {
    Route::get('/', 'index');
    Route::post('/store', 'store');
    Route::get('/data', 'orderData');
    Route::get('/{id}', 'show');
});

// User fetch areas
Route::get('/areas/{city_id}', [UserAreaController::class, 'getByCity']);

// Admin Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::prefix('admin')->name('admin.')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    // Protected Admin Routes
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('categories', CategoryController::class);
        Route::resource('cities', CityController::class);
        Route::resource('areas', AreaController::class);
        Route::resource('products', ProductController::class);
        Route::post('products/{product}/upload-image', [ProductController::class, 'uploadImage'])->name('products.uploadImage');
        Route::delete('products/remove-image/{id}', [ProductController::class, 'removeImage'])->name('products.removeImage');

        Route::get('products/{id}/images', [ProductController::class, 'getProductImages'])->name('products.getImages');
        Route::resource('blogs', BlogController::class);
        Route::resource('contact_us', AdminContactUsController::class);
        Route::resource('users', UserController::class);

        Route::controller(AdminOrderController::class)->prefix('orders')->name('orders.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/data', 'orderData');
            Route::get('/{id}', 'show')->name('show');
            Route::post('/{id}/update-status', 'updateStatus')->name('update_status');
        });

    });
});


// Shop routes
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/product/{slug}', [ShopController::class, 'show'])->name('product.show');


Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');
Route::post('/checkout', [CheckoutController::class, 'submit'])->name('checkout.submit');


Route::post('/admin/products', [ProductController::class, 'store'])->name('admin.products.store');


Route::post('/cart/add', [CartController::class, 'add']);
Route::post('/cart/update/{id}', [CartController::class, 'update']);
Route::get('/cart/count', [CartController::class, 'countItem']);


Route::delete('/cart/remove/{key}', [CartController::class, 'delete']);


Route::get('/shop/{slug}', [ShopController::class, 'category']);
// Route::get('/shop/gold', [ShopController::class, 'gold'])->name('shop.gold');
// Route::get('/shop/deluxe', [ShopController::class, 'deluxe'])->name('shop.deluxe');
// Route::get('/shop/gift', [ShopController::class, 'gift'])->name('shop.gift');
// Route::get('/shop/coffee', [ShopController::class, 'coffee'])->name('shop.coffee');
// Route::get('/shop/nuts', [ShopController::class, 'nuts'])->name('shop.nuts');
