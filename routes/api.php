<?php

use App\Http\Controllers\ImageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\sendImage;
use App\Http\Controllers\ImageController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/image/menu/{imagePath}', [ImageController::class, 'getImageByPath'])->name('getImageByPath');

// Route::get('storage/images/menu/{filename}', [sendImage::class, 'sendImageMenu']);
Route::get('storage/images/menu/{imagePath}', [ImageController::class, 'getImageMenuByPath'])->name('getImageMenuByPath');
Route::get('storage/images/shop/{imagePath}', [ImageController::class, 'getImageShopByPath'])->name('getImageShopByPath');