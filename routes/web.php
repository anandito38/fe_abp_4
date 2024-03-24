<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
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
Route::group(['namespace' => 'App\Http\Controllers'], function()
{  
    // Route::get('/shop', 'controller_test@getAllShops');
    Route::get('/isi/{id}', 'controller_test@isiShops');
    // Route::get('/menu', 'controller_test@getAllMenu');
    // Route::get('/menu/{id}', 'controller_test@getAllMenu');

});

// Route::get('/menu', function () {
//     return view('menus');
// });

Route::get('/', function () {
    return redirect('/index');
});

Route::controller(AuthController::class)->group(function(){
    Route::post('/login', 'login')->middleware('guest');
    Route::post('/panel', 'getUserInfo');
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
    Route::get('/menu/byshop', 'getMenuById');
});
Route::controller(ShopController::class)->group(function(){
    Route::get('/shop/all', 'getAllShop');
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
        return view('admin.panel');
    });

    Route::get('/register', function () {
        return view('log.register');
    });
});

Route::any('{any}', function () {
    return view('errors.404');
})->where('any', '.*');

