<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CheckoutController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Route::get('/', function () {
//     return redirect('/login');
// });

// Route::get('/menu', function () {
//     return view('menus');
// });

Route::get('/', function () {
    return redirect('/index');
});

Route::controller(AuthController::class)->group(function(){
    Route::post('/login', 'login')->middleware('guest');
    // Route::get('/panel', 'getUserInfo');
    Route::get('/logoutt', 'logout');
    Route::get('/index', 'AuthDashboard');
    Route::post('/register', 'register');
    
});

Route::controller(UserController::class)->group(function(){
    Route::get('/user/all', 'getAllUser');
    Route::put('/user/edit', 'editUser');
    Route::delete('/user/delete', 'deleteUser');
});

Route::controller(MenuController::class)->group(function(){
    Route::get('/menu/all', 'getAllMenu');
    Route::post('/menu/byShop', 'getMenuById');
    Route::post('/menu/add', 'addMenu');
    Route::post('/menu/edit', 'editMenu');
    Route::post('/menu/delete', 'deleteMenu');
});
Route::controller(ShopController::class)->group(function(){
    Route::get('/shop/all', 'getAllShop');
    Route::get('/shop/byUser', 'getShopByUserId');
    Route::get('/shop/byUser/menu', 'getShopMenuByUserId');
    Route::post('/shop/add', 'addShop');
    Route::post('/shop/edit', 'editShop');
    Route::post('/shop/delete', 'deleteShop');
    Route::get('/shop/booking/menu', 'getAllPaidedMenuByShop');
    Route::post('/menu/done/paid/byShop', 'donePaidedMenuByShop');

});

Route::controller(BookingController::class)->group(function(){
    Route::post('/invoice/add', 'addInvoice');
    // Route::post('/shop/byUser/menu', 'getShopMenuByUserId');
    // Route::post('/shop/add', 'addShop');
    // Route::post('/shop/edit', 'editShop');
    
});

Route::controller(CheckoutController::class)->group(function(){
    Route::post('/menu/cart/add', 'addCart');
    Route::get('/booking/detail/menu', 'showCart');
    Route::post('/menu/cart/delete', 'deleteCart');
    Route::post('/menu/cart/edit', 'editCart');
});


Route::group([], function(){
    Route::get('/login', function () {
        return view('log.login');
        // if (Auth::check()) {
        //     return redirect('/panel');
        // } else {
        //     return view('log.login');
        // }
    });

    Route::get('/panel', function () {
        return view('admin.dashboard');
    });

    Route::get('/register', function () {
        return view('log.register');
    });

    Route::get('/cekk', function () {
        return view('admin.dashboard');
    });
});

Route::any('{any}', function () {
    return view('errors.404');
})->where('any', '.*');

