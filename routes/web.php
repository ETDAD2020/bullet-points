<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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
Route::get('/login', function () {
    if (Auth::user()) {
        return redirect()->route('home');
    }
    return view('login');
})->name('login');

Route::middleware(['auth.shopify'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    // Other routes that need the shop user
});

Route::get('/dashboard', function () {
    // $user_id = $request->id;
    // Auth::loginUsingId($user_id, $remember = true);
    return view('welcome');
})->name('dashboards');
Route::resource('products', 'ProductsController');
Route::resource('settings', 'CustomizersController');
Route::get('/instructions', 'CustomizersController@showInstructions')->name('instructions');
Route::get('sync/products', 'ProductsController@storeProducts1')->name('sync.products');
Route::middleware(['auth.shopify'])->group(function () {
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



