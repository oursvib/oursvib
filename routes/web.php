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


Route::get('/', '\App\Http\Controllers\LandingController@index');

Auth::routes(['verify' => true]);

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('home', '\App\Http\Controllers\HomeController@index')->name('home');
Route::post('setcountry', '\App\Http\Controllers\LandingController@setCountry')->name('setcountry');
Route::post('validate_email', '\App\Http\Controllers\Auth\RegisterController@validateEmail')->name('validate.email');
Route::post('validate_email_edit', '\App\Http\Controllers\UserController@validateEmailEdit')->name('validate.email.edit');
Route::post('validate_email_add', '\App\Http\Controllers\UserController@validateEmailAdd')->name('validate.email.add');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/adminlogin', '\App\Http\Controllers\AdminController@showLoginForm')->name('admin.login');
Route::get('/vendorslogin', '\App\Http\Controllers\VendorsController@showLoginForm')->name('vendors.login');
Route::get('/avendorslogin', '\App\Http\Controllers\AvendorController@showLoginForm')->name('avendors.login');
Route::get('/vregistration', '\App\Http\Controllers\Auth\RegisterController@showVendorRegistrationForm')->name('vendors.register');
Route::get('/viewlistingbycategory/{category}', '\App\Http\Controllers\LandingController@viewListingByCategory')->name('viewbycategory');

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
    Route::get('/addlisting', '\App\Http\Controllers\ListingController@addListing')->name('admin.listing.add');
    Route::post('/savelisting', '\App\Http\Controllers\ListingController@saveListing')->name('savelisting');
    Route::post('/deletelisting', '\App\Http\Controllers\ListingController@deleteListing')->name('deletelisting');
    Route::get('/editlisting', '\App\Http\Controllers\ListingController@editListing')->name('editlisting');
    Route::post('/updatelisting', '\App\Http\Controllers\ListingController@updateListing')->name('updatelisting');
    Route::post('/approvelisting', '\App\Http\Controllers\ListingController@approveListing')->name('approvelisting');
    Route::post('/unapprovelisting', '\App\Http\Controllers\ListingController@unapproveListing')->name('unapprovelisting');

    Route::get('/users', '\App\Http\Controllers\UserController@index')->name('admin.manage.users');
    Route::post('/deleteuser', '\App\Http\Controllers\UserController@deleteUser')->name('admin.delete.user');
    Route::post('/suspenduser', '\App\Http\Controllers\UserController@suspendUser')->name('admin.suspend.user');
    Route::post('/activateuser', '\App\Http\Controllers\UserController@activateUser')->name('admin.delete.user');
    Route::get('/edituser', '\App\Http\Controllers\UserController@editUser')->name('admin.edit.user');
    Route::get('/adduser', '\App\Http\Controllers\UserController@addUser')->name('admin.add.user');
    Route::post('/updateuser', '\App\Http\Controllers\UserController@updateUser')->name('admin.update.user');
    Route::post('/saveuser', '\App\Http\Controllers\UserController@saveUser')->name('admin.save.user');

    Route::get('/admincalender', '\App\Http\Controllers\BookingController@index')->name('admin.booking.calender');
    Route::post('/updatebooking', '\App\Http\Controllers\BookingController@editBooking')->name('admin.booking.edit');
    Route::post('/viewbooking', '\App\Http\Controllers\BookingController@viewBooking')->name('admin.booking.view');
    Route::get('/addbooking', '\App\Http\Controllers\BookingController@addBooking')->name('admin.booking.add');

});
Route::post('getparentcategory', '\App\Http\Controllers\HelperController@getParentCategory');
Route::post('getchildcategory', '\App\Http\Controllers\HelperController@getChildCategory');
Route::post('getnichecategory', '\App\Http\Controllers\HelperController@getNicheCategory');
Route::post('getstates', '\App\Http\Controllers\HelperController@getStates');
Route::post('getcities', '\App\Http\Controllers\HelperController@getCities');



Route::prefix('vendors')->middleware(['vendors', 'verified'])->group(function () {
    Route::get('/', '\App\Http\Controllers\VendorsController@index')->name('vendors.dashboard');
    Route::get('/addlisting', '\App\Http\Controllers\VendorsController@addListing')->name('vendors.listing.add');
    Route::post('/savelisting', '\App\Http\Controllers\VendorsController@saveListing')->name('savelisting');
    Route::get('/editlisting', '\App\Http\Controllers\VendorsController@editListing')->name('vendors.editlisting');
    Route::post('/updatelisting', '\App\Http\Controllers\VendorsController@updateListing')->name('updatelisting');

    Route::get('/vendorcalender', '\App\Http\Controllers\VendorsController@vendorCalender')->name('vendor.booking.calender');
    Route::post('/viewbooking', '\App\Http\Controllers\VendorsController@viewBooking')->name('vendor.booking.view');
    Route::get('/addbooking', '\App\Http\Controllers\VendorsController@addBooking')->name('vendor.booking.add');
    Route::post('/blockbooking', '\App\Http\Controllers\VendorsController@blockBooking')->name('vendor.booking.block');

});

Route::prefix('avendors')->middleware(['avendors', 'verified'])->group(function () {
    Route::get('/', '\App\Http\Controllers\AvendorController@index')->name('avendors.dashboard');

});

Route::get('/customer', '\App\Http\Controllers\CustomerController@index')->name('customer')->middleware('customer');

Route::get('/email', function(){
    return view('email.newlisting');
})->name('email');
