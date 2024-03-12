<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', function () {
    return view('login');
});
Route::get('/test', function () {
    return view('test');
});

Route::controller(AuthController::class)->group(function(){
    Route::post('/login', 'login');
    Route::post('/logout', 'logout');
});

Route::any('{any}', function () {
    return view('errors.404');
})->where('any', '.*');
