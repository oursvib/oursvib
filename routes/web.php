<?php

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
});
Auth::routes(['verify' => true]);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('home', '\App\Http\Controllers\HomeController@index')->name('home');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/adminlogin', '\App\Http\Controllers\AdminController@showLoginForm')->name('admin.login');
Route::get('/vendorslogin', '\App\Http\Controllers\VendorsController@showLoginForm')->name('vendors.login');
Route::get('/avendorslogin', '\App\Http\Controllers\AvendorController@showLoginForm')->name('avendors.login');
Route::get('/vregistration', '\App\Http\Controllers\Auth\RegisterController@showVendorRegistrationForm')->name('vendors.register');

Route::prefix('admin')->middleware(['admin', 'verified'])->group(function () {
    Route::get('/', '\App\Http\Controllers\AdminController@index')->name('admin.dashboard');
    Route::get('/category', '\App\Http\Controllers\CategoryController@index')->name('admin.manage.category');
    Route::get('/addparentcategory', '\App\Http\Controllers\CategoryController@addParentCategory');
    Route::get('/addchildcategory', '\App\Http\Controllers\CategoryController@addChildCategory');
    Route::get('/addnichecategory', '\App\Http\Controllers\CategoryController@addNicheCategory');
    Route::post('/saveparentcategory', '\App\Http\Controllers\CategoryController@saveParentCategory');
    Route::post('/savechildcategory', '\App\Http\Controllers\CategoryController@saveChildCategory');
    Route::post('/savenichecategory', '\App\Http\Controllers\CategoryController@saveNicheCategory');

    Route::get('/managelisting', '\App\Http\Controllers\ListingController@index')->name('admin.manage.listing');

});

Route::prefix('vendors')->middleware(['vendors', 'verified'])->group(function () {
    Route::get('/', '\App\Http\Controllers\VendorsController@index')->name('vendors.dashboard');

});

Route::prefix('avendors')->middleware(['avendors', 'verified'])->group(function () {
    Route::get('/', '\App\Http\Controllers\AvendorController@index')->name('avendors.dashboard');

});

Route::get('/customer', '\App\Http\Controllers\CustomerController@index')->name('customer')->middleware('customer');
