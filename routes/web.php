<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CatergoryController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;

Auth::routes();

Route::get('login-register', [LoginController::class, 'showLoginRegisterForm'])->name('login-register');


Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/contact', [HomeController::class, 'contact'])->name('home.contact');
Route::post('/contact/store', [HomeController::class, 'contact_store'])->name('home.contact.store');


Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
// Route::get('/shop/{category}', [ShopController::class, 'showByCategory'])->name('shop.category');
Route::get('/shop/{slug}', [ShopController::class, 'product_details'])->name('shop.product_details');

Route::prefix('/user')->middleware(['auth'])->group(function(){
    Route::get('/user-dashboard', [UserController::class, 'index'])->name('user.index');
    Route::get('/details', [UserController::class, 'user_view'])->name('user.user.details');
    Route::put('/update_password', [UserController::class, 'update_password'])->name('user.password.update');
    Route::get('/orders', [UserController::class, 'order_view'])->name('user.orders');
});
Route::post('/order/submit', [OrderController::class, 'order_save'])->name('user.order.save');
Route::delete('/order/delete/{id}', [OrderController::class, 'cancle_order'])->name('user.order.delete');
Route::get('/order/success', [OrderController::class, 'success_response'])->name('user.order.success');


Route::prefix('/admin')->middleware(['auth',AuthAdmin::class])->group(function(){
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.index');

    Route::get('/brands', [BrandController::class, 'index'])->name('admin.brands');
    Route::get('/brand/create', [BrandController::class, 'create'])->name('admin.brand.add');
    Route::post('/brand/store', [BrandController::class, 'store'])->name('admin.brand.store');
    Route::get('/brand/edit/{id}', [BrandController::class, 'edit'])->name('admin.brand.edit');
    Route::put('/brand/update', [BrandController::class, 'update'])->name('admin.brand.update');
    Route::delete('/brand/delete/{id}', [BrandController::class, 'delete'])->name('admin.brand.delete');
    
    Route::get('/categories', [CatergoryController::class, 'index'])->name('admin.categories');
    Route::get('/category/create', [CatergoryController::class, 'create'])->name('admin.category.create');
    Route::post('/category/store', [CatergoryController::class, 'store'])->name('admin.category.store');
    Route::get('/category/edit/{id}', [CatergoryController::class, 'edit'])->name('admin.category.edit');
    Route::put('/category/update', [CatergoryController::class, 'update'])->name('admin.category.update');
    Route::delete('/category/delete/{id}', [CatergoryController::class, 'delete'])->name('admin.category.delete');

    Route::get('/products', [ProductController::class, 'index'])->name('admin.products');
    Route::get('/product/create', [ProductController::class, 'create'])->name('admin.product.create');
    Route::post('/product/store', [ProductController::class, 'store'])->name('admin.product.store');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('admin.product.edit');
    Route::put('/product/update', [ProductController::class, 'update'])->name('admin.product.update');
    Route::delete('/product/delete/{id}', [ProductController::class, 'delete'])->name('admin.product.delete');
    
    Route::get('/messages', [MessageController::class, 'index'])->name('admin.messages');
    Route::delete('/message/{id}', [MessageController::class, 'delete'])->name('admin.message.delete');

    Route::get('/users', [UserController::class, 'users'])->name('admin.users');
    Route::get('/user/create', [UserController::class, 'create'])->name('admin.user.create');
    Route::post('/user/store', [UserController::class, 'store'])->name('admin.user.store');
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('admin.user.edit');
    Route::put('/user/update/{id}', [UserController::class, 'update'])->name('admin.user.update');
    Route::delete('/user/delete/{id}', [UserController::class, 'delete'])->name('admin.user.delete');

    Route::get('/user_info', [UserController::class, 'user_info'])->name('admin.user.info');
    Route::put('/update_password', [UserController::class, 'update_password'])->name('admin.user.password.update');

    Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders');
    Route::get('/order/details/{id}', [OrderController::class, 'order_details'])->name('admin.order.details');
    Route::put('/order/update/status', [OrderController::class, 'update_order_status'])->name('admin.update.order.status');
});