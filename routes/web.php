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
//     return Inertia::render('Home')->withViewData(["title" => "HomePage"]);
// });
Route::get('/', [HomeController::class, 'index'])->middleware(['auth.shopify'])->name('home');
Route::post('/app-setting-product', [AppSetting::class, 'app_set_product'])->middleware(['auth.shopify'])->name('app-setting-product');
Route::post('/app-setting-cart', [AppSetting::class, 'app_set_cart'])->middleware(['auth.shopify'])->name('app-setting-cart');
Route::post('/set-notification', [AppSetting::class, 'notification_setting'])->middleware(['auth.shopify'])->name('set-notification');
Route::get('/get-app-settings', [AppSetting::class, 'get_app_settings'])->name('get-app-settings');
Route::get('/get-popup-type', [HomeController::class, 'get_popup'])->middleware(['auth.shopify'])->name('show_pop_up');;

Route::resource('user', UserController::class);

Route::post('webhook/orders-create', [OrderWebhook::class, 'index'])->name('orders-create');
// Route::post('webhook/app-uninstall', [UninstallWebhook::class, 'index'])->name('app-setting-cart');
