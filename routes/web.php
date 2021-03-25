<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomizersController;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
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

Route::get('/', function(){
    return view('welcome');
})->middleware(['auth.shopify'])->name('home');

Route::get('/dashboard', function () {
    return view('welcome');
})->middleware(['auth.shopify'])->name('dashboards');
Route::resource('products', 'ProductsController');
Route::resource('settings', 'CustomizersController');
Route::get('/instructions', 'CustomizersController@showInstructions')->name('instructions');
Route::get('sync/products', 'ProductsController@storeProducts1')->name('sync.products');



