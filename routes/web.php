<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
})->middleware(['auth.shopify', 'billable'])->name('home');

Route::resource('products', 'ProductsController');
Route::resource('settings', 'CustomizersController');
Route::get('/instructions', 'CustomizersController@showInstructions')->name('instructions');
Route::middleware(['auth.shopify'])->group(function () {
    Route::get('sync/products', 'ProductsController@storeProducts')->name('sync.products');
});





//Auth::routes();

Route::post('/admin/login','Auth\LoginController@login');

Route::middleware(['admin'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('dashboard');
    Route::get('/stores', 'AdminController@stores')->name('stores.index');
    Route::get('/plans', 'AdminController@plans')->name('plans.index');
    Route::put('/plans/update/{id}', 'AdminController@updatePlan')->name('plans.update');
});


Route::get('/admin', function() {
    return view('auth.login');
});



