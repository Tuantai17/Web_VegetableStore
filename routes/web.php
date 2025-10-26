<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\ProductController as SanPhamController;
use App\Http\Controllers\frontend\ContactController as LienHeController;
use App\Http\Controllers\frontend\UserController as NguoiDungController;

// Admin controllers
use App\Http\Controllers\backend\AuthController;

use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\BannerController;
use App\Http\Controllers\backend\BrandController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\ContactController;
use App\Http\Controllers\backend\MenuController;
use App\Http\Controllers\backend\MigrationsController;
use App\Http\Controllers\backend\OrderController;
use App\Http\Controllers\backend\PostController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\backend\TopicController;
use App\Http\Controllers\backend\UserController;
use Illuminate\Support\Facades\Auth;
// Frontend routes
Route::get('/', [HomeController::class, 'index'])->name('site.home');
Route::get('/san-pham', [SanPhamController::class, 'index'])->name('site.product');
Route::get('/san-pham/{slug}', [SanPhamController::class, 'detail'])->name('site.product.detail');
// Hiển thị trang liên hệ
Route::get('/lien-he', [HomeController::class, 'contact'])->name('site.contact');

// Xử lý form liên hệ (quan trọng!)
Route::post('/lien-he', [HomeController::class, 'submitContact'])->name('site.contact.submit');

// tìm kiếm
Route::get('tim-kiem', [HomeController::class, 'searchProduct'])->name('site.product.search');
Route::get('danh-muc/{category_slug}', [SanPhamController::class, 'byCategory'])->name('site.product.byCategory');


// ...
Route::get('dang-ky',  [UserController::class, 'registerForm'])->name('user.register.form');
Route::post('dang-ky', [UserController::class, 'doRegister'])->name('user.register');
// ...




Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('user.register.form')->with('success', 'Bạn đã đăng xuất thành công!');
})->name('logout');


// ✅ Route xử lý login frontend
Route::post('/loginngdung', [NguoiDungController::class, 'login'])->name('login.store');
Route::get('/loginngdung', [NguoiDungController::class, 'login'])->name('loginngdung');

// Route cho form đăng nhập của shop
Route::get('/login', [UserController::class, 'showLoginForm'])->name('site.login');





//MƠI HTEME\
Route::get('/danh-muc/{slug}', [ProductController::class, 'category'])->name('site.category');
Route::get('/tat-ca-bai-viet', [HomeController::class, 'allPosts'])->name('site.posts.all');
Route::get('chi-tiet-bai-viet/{slug}', [HomeController::class, 'detail'])->name('site.post.detail');



// Route::get('/bai-viet/{slug}', [PostController::class, 'detail'])->name('site.post.detail');
Route::get('/bchu-de/{slug}', [TopicController::class, 'detail'])->name('site.topic.detail');

// Additional pages
//Route::get('/login', [HomeController::class, 'login'])->name('site.login');
Route::get('/register', [HomeController::class, 'register'])->name('site.register');
Route::get('/about', [HomeController::class, 'about'])->name('site.about');
Route::get('/newpage', [HomeController::class, 'newpage'])->name('site.newpage');

Route::get('/tai-khoan', [HomeController::class, 'accountInfo'])->name('user.account')->middleware('auth');
Route::post('/tai-khoan/cap-nhat', [HomeController::class, 'updateAccount'])->name('user.account.update')->middleware('auth');



// giỏ hành
Route::get('/gio-hang', [SanPhamController::class, 'cart'])->name('site.cart');
Route::post('/them-vao-gio-hang', [SanPhamController::class, 'addToCart'])->name('site.cart.add');
Route::post('/cap-nhat-so-luong', [SanPhamController::class, 'updateCart'])->name('site.cart.update');
Route::post('/xoa-gio-hang', [SanPhamController::class, 'removeFromCart'])->name('site.cart.remove');

Route::post('/xoa-toan-bo-gio-hang', function () {
    session()->forget('cart');
    return redirect()->back()->with('success', 'Đã xóa toàn bộ giỏ hàng!');
})->name('site.cart.clear');
Route::post('/thanh-toan', [SanPhamController::class, 'checkout'])->name('site.cart.checkout');
Route::get('/thanh-toan', [SanPhamController::class, 'checkoutForm'])->name('site.cart.checkout');
Route::post('/thanh-toan', [SanPhamController::class, 'checkoutSubmit'])->name('site.cart.checkout.submit');







//khai báo group admin
Route::get('loginad',[AuthController::class,'login'])->name('admin.loginad');
Route::post('loginad',[AuthController::class,'dologin'])->name('admin.dologinad');
//đăng xuất
Route::post('/admin/logout', function () {
    Auth::guard('admin')->logout();
    return redirect()->route('admin.loginad')->with('success', 'Admin đã đăng xuất thành công!');
})->name('admin.logout');


// Admin routes

Route::prefix('admin')->middleware('loginadmin')->group(function () {
    // Route::prefix('admin')->group (function () {



    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Product management
    Route::prefix('product')->group(function () {
        Route::get('trash', [ProductController::class, 'trash'])->name('product.trash');
        Route::get('delete/{product}', [ProductController::class, 'delete'])->name('product.delete');
        Route::get('restore/{product}', [ProductController::class, 'restore'])->name('product.restore');
        Route::get('status/{product}', [ProductController::class, 'status'])->name('product.status');
        Route::get('admin/product/{id}', [ProductController::class, 'show'])->name('product.show');

    });
    Route::resource('product', ProductController::class);

    // Category management

    Route::prefix('category')->group(function () {
        Route::get('trash', [CategoryController::class, 'trash'])->name('category.trash');
        Route::get('delete/{category}', [CategoryController::class, 'delete'])->name('category.delete');
        Route::get('restore/{category}', [CategoryController::class, 'restore'])->name('category.restore');
        Route::get('status/{category}', [CategoryController::class, 'status'])->name('category.status');
        Route::get('admin/category/{category}', [CategoryController::class, 'show'])->name('category.show');

    });
    Route::resource('category', CategoryController::class);
    // Brand management

    Route::prefix('brand')->group(function () {
        Route::get('trash', [BrandController::class, 'trash'])->name('brand.trash');
        Route::get('delete/{brand}', [BrandController::class, 'delete'])->name('brand.delete');
        Route::get('restore/{brand}', [BrandController::class, 'restore'])->name('brand.restore');
        Route::get('status/{brand}', [BrandController::class, 'status'])->name('brand.status');
        Route::get('admin/thuong-hieu/{id}', [BrandController::class, 'show'])->name('thuonghieu.show');

    });
    Route::resource('brand', BrandController::class);
    // Banner management
    
    Route::prefix('banner')->group(function () {
        Route::get('trash', [BannerController::class, 'trash'])->name('banner.trash');
        Route::get('delete/{banner}', [BannerController::class, 'delete'])->name('banner.delete');
        Route::get('restore/{banner}', [BannerController::class, 'restore'])->name('banner.restore');
        Route::get('status/{banner}', [BannerController::class, 'status'])->name('banner.status');
        Route::get('banner/{banner}', [BannerController::class, 'show'])->name('banner.show');
    });
    Route::resource('banner', BannerController::class);

    // Contact management

    Route::prefix('contact')->group(function () {
        Route::get('trash', [ContactController::class, 'trash'])->name('contact.trash');
        Route::get('delete/{contact}', [ContactController::class, 'delete'])->name('contact.delete');
        Route::get('restore/{contact}', [ContactController::class, 'restore'])->name('contact.restore');
        Route::get('status/{contact}', [ContactController::class, 'status'])->name('contact.status');
        Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
        Route::get('contacts', [ContactController::class, 'index'])->name('admin.contacts.index');
        Route::post('admin/contact/reply/{id}', [ContactController::class, 'reply'])->name('contact.reply');
        
    });
    Route::resource('contact', ContactController::class);
    // Menu management

    Route::prefix('menu')->group(function () {
        Route::get('trash', [MenuController::class, 'trash'])->name('menu.trash');
        Route::get('delete/{menu}', [MenuController::class, 'delete'])->name('menu.delete');
        Route::get('restore/{menu}', [MenuController::class, 'restore'])->name('menu.restore');
        Route::get('status/{menu}', [MenuController::class, 'status'])->name('menu.status');
        Route::get('admin/menu/{menu}', [MenuController::class, 'show'])->name('menu.show');

    });
    Route::resource('menu', MenuController::class);
    // Order management

    Route::prefix('order')->group(function () {
        Route::get('trash', [OrderController::class, 'trash'])->name('order.trash');
        Route::get('delete/{order}', [OrderController::class, 'delete'])->name('order.delete');
        Route::get('restore/{order}', [OrderController::class, 'restore'])->name('order.restore');
        Route::get('status/{order}', [OrderController::class, 'status'])->name('order.status');
        Route::get('admin/order/{id}', [OrderController::class, 'show'])->name('order.show');
        Route::get('admin/order/status/{order}', [OrderController::class, 'status'])->name('admin.order.status');
        //mới
        Route::get('order/toggle-status/{id}', [OrderController::class, 'toggleStatus'])->name('order.toggleStatus');

    });
    Route::resource('order', OrderController::class);
    // Post management

    Route::prefix('post')->group(function () {
        Route::get('trash', [PostController::class, 'trash'])->name('post.trash');
        Route::get('restore/{post}', [PostController::class, 'restore'])->name('post.restore');
        Route::get('status/{post}', [PostController::class, 'status'])->name('post.status');
        Route::get('admin/post/show/{id}', [PostController::class, 'show'])->name('post.show');


        Route::delete('/delete/{id}', [PostController::class, 'destroy'])->name('post.delete');
        // Đổi tên route delete thành something else
        Route::get('delete/{post}', [PostController::class, 'delete'])->name('post.delete');
    });
    
    Route::resource('post', PostController::class);
    // Topic management

    Route::prefix('topic')->group(function () {
        Route::get('trash', [TopicController::class, 'trash'])->name('topic.trash');
        Route::get('delete/{topic}', [TopicController::class, 'delete'])->name('topic.delete');
        Route::get('restore/{topic}', [TopicController::class, 'restore'])->name('topic.restore');
        Route::get('status/{topic}', [TopicController::class, 'status'])->name('topic.status');
        Route::get('/topic/{id}', [TopicController::class, 'show'])->name('topic.show');

    });
    Route::resource('topic', TopicController::class);
    // User management

    Route::prefix('user')->group(function () {
        Route::get('trash', [UserController::class, 'trash'])->name('user.trash');
        Route::get('delete/{user}', [UserController::class, 'delete'])->name('user.delete');
        Route::get('restore/{user}', [UserController::class, 'restore'])->name('user.restore');
        Route::get('status/{user}', [UserController::class, 'status'])->name('user.status');
        //
        Route::get('admin/user/customer', [UserController::class, 'customerList'])->name('user.customer');
        Route::get('/user/{user}', [UserController::class, 'show'])->name('user.show');
Route::delete('user/force-delete/{user}', [UserController::class, 'forceDelete'])->name('user.forceDelete');

    });
    Route::resource('user', UserController::class);
});
