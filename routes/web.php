<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AppSetting;
use App\Http\Controllers\OrderWebhook;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
// use UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return Inertia::render('Home');
// })->middleware(['auth.shopify']);
Route::get('/', [HomeController::class, 'index'])->middleware(['auth.shopify'])->name('home');
Route::post('/disable-settings', [AppSetting::class, 'disable_settings'])->middleware(['auth.shopify'])->name('disable-settings');
Route::get('/get-app-settings', [AppSetting::class, 'get_app_settings'])->name('get-app-settings');
