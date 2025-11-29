<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Auth\CustomerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductDetailsController;

Route::get('/', function () {
    return view('home');
});

// Route to show the checkout page



Route::get('/', [HomeController::class, 'index'])->name('home'); 
//category routes
Route::get('/category/{id}', [CategoryController::class, 'index'])->name('category.show');

Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');


//Register route
Route::get('/signup', [RegistrationController::class, 'showSignupForm'])->name('auth');
Route::post('/signup', [RegistrationController::class, 'signup'])->name('signup');
Route::get('/login', [RegistrationController::class, 'showLoginForm'])->name('auth');
Route::post('/login', [RegistrationController::class, 'login'])->name('login');
Route::post('/logout', [RegistrationController::class, 'logout'])->name('logout');
Route::get('/contact-us', [ContactController::class, 'index'])->name('contact.show');
Route::post('/contact-us', [ContactController::class, 'submit'])->name('contact.submit');




Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::post('/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
});





// Admin routes with prefix and middleware
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashbord', [AdminController::class, 'index'])->name('admin.dashbord');
    Route::get('/users', [AdminController::class, 'show'])->name('admin.users');
    Route::get('/admin/mail/{id?}', [AdminController::class, 'showEmails'])->name('admin.mail');
    Route::get('mail/{id}', [AdminController::class, 'showEmails'])->name('admin.mail_detail');
    Route::post('/admin/mail/reply/{id}', [AdminController::class, 'sendReply'])->name('admin.reply');
    Route::get('/categories', [AdminController::class, 'category'])->name('admin.category');
    Route::post('/categories', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/category/{id}/edit', [AdminController::class, 'edit'])->name('admin.editcategory');
    Route::put('/category/{id}', [AdminController::class, 'update'])->name('admin.updatecategory');
    Route::delete('/category/{id}', [AdminController::class, 'destroy'])->name('admin.deletecategory');
//     Route::get('profile', [ProfileController::class, 'showProfile'])->name('profile.show');
//     Route::get('profile/edit', [ProfileController::class, 'editProfile'])->name('profile.edit');
//     Route::post('profile/edit', [ProfileController::class, 'updateProfile'])->name('profile.update');  
//    Route::get('/password/change', [ProfileController::class, 'showChangePasswordForm'])->name('password.change');
//    Route::post('/password/update', [ProfileController::class, 'changePassword'])->name('password.update');

    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
   

});

// Customer routes middleware
Route::middleware('auth')->group(function () {
    Route::get('/dashbord', [CustomerController::class, 'index'])->name('customer.dashbord');
     Route::get('profile', [ProfileController::class, 'showProfile'])->name('profile.show');
    Route::get('profile/edit', [ProfileController::class, 'editProfile'])->name('profile.edit');
    Route::post('profile/edit', [ProfileController::class, 'updateProfile'])->name('profile.update');  
   Route::get('/password/change', [ProfileController::class, 'showChangePasswordForm'])->name('password.change');
   Route::post('/password/update', [ProfileController::class, 'changePassword'])->name('password.update');
    Route::get('/notifications', [CustomerController::class, 'notify'])->name('customer.notification');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('cart.checkout');
    Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
    Route::get('/orders', [AdminController::class, 'showOrder'])->name('admin.orders');

    
   
});


Route::get('/products/{id}', [ProductDetailsController::class, 'showDetails'])->name('products.showdetails');
Route::get('/products/{id}/details', [ProductDetailsController::class, 'showDetails'])->name('products.showdetails');
Route::get('/search', [ProductController::class, 'search'])->name('products.search');



//Route::get('/category/{id}/products', [ProductController::class, 'showProductsByCategory'])->name('category.products');
