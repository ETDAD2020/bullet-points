<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ReferralController;
use App\Http\Controllers\ReferralVisitController;
use App\Http\Controllers\ReferralUserController;
use App\Http\Controllers\WithdrawalRequestController;
use App\Http\Controllers\WithdrawalManagerController;
use App\Http\Controllers\PopupSettingController;
use Illuminate\Support\Facades\Route;
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

Route::get('/', [HomeController::class, 'index'])->middleware(['auth.shopify'])->name('home');

Route::get('/orders', [OrderController::class, 'orders'])->middleware(['auth.shopify'])->name('orders-view');

Route::get('/settings', [SettingsController::class, 'settings'])->middleware(['auth.shopify'])->name('settings-view');
Route::post('/update-email-settings', [SettingsController::class, 'update_email_setting'])->middleware(['auth.shopify'])->name('update-email-settings');
Route::post('/update-app-settings', [SettingsController::class, 'update_app_setting'])->middleware(['auth.shopify'])->name('update-app-setting');
Route::get('/get-app-settings', [SettingsController::class, 'get_app_setting'])->name('get-app-setting');
Route::post('/update-amount', [SettingsController::class, 'update_amount'])->name('update-amount');


Route::get('/referral-manager', [ReferralController::class, 'referral_manager'])->middleware(['auth.shopify'])->name('referral-manager-view');
Route::post('/add-referrals', [ReferralController::class, 'index'])->name('add-referral');
Route::get('/generate-referral-url', [ReferralController::class, 'generate_referral_url'])->name('generate-referral-url');
Route::post('/check-referrals', [ReferralController::class, 'check_referral'])->name('check-referral');

Route::get('/referral/{referral_code}', [ReferralVisitController::class, 'index'])->name('referral-link-code');

Route::get('/withdrwal-manager', [WithdrawalManagerController::class, 'index'])->name('withdrwal-manager');
Route::post('/withdrawal-update-status', [WithdrawalManagerController::class, 'withdrawal_update_status'])->name('withdrawal-update-status');

Route::post('/login-user', [HomeController::class, 'login'])->name('login-user');

Auth::routes();
Route::group(['middleware' => ['auth']], function () {
    //For Referral User
    Route::get('/referral-dashboard', [ReferralUserController::class, 'index'])->name('referral-dashboard');
    //Withdrawal
});
Route::post('/withdrwal-request', [WithdrawalRequestController::class, 'index'])->name('withdrwal-request');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/popup-settings', [PopupSettingController::class, 'index'])->name('popup-setting-view');
Route::post('/update-popup-settings', [PopupSettingController::class, 'update_popup_setting'])->name('update-popup-settings');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
