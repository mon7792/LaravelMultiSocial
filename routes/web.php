<?php

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

Route::get('/', 'TestController@index');

Auth::routes();

// Products URL
Route::resource('products','ProductsController');

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home','HomeController@userRegistration')->name('home.post');

// Login using microsoft login
Route::middleware(['guest'])->group(function () {
    Route::get('auth/microsoft', 'AuthController@redirectToProvider');
});

// microsoft routes
Route::get('auth/microsoft/callback', 'AuthController@handleProviderCallback');


//localadmin routes
//GET: localadmin login form
Route::get('localadmin/login', 'AdminLoginController@showLoginForm');
//POST: localadmin login form
Route::post('localadmin/login', 'AdminLoginController@login')->name('admin.login.submit');
//localadmin routes to get all users.
Route::get('localadmin/user', 'AdminController@findUser')->name('admin.findUser');
//localadmin dashboard after login.
Route::get('localadmin/dashboard', 'AdminController@index')->name('admin.dashboard');

//admin & Staff routes
//Display available categories
Route::get('admin/categories', 'StaffAdminController@showCategories')->name('adminstaff.categories');

//add categories
Route::post('admin/categories', 'StaffAdminController@addNewCategories')->name('adminstaff.newcategories');

//remove category
Route::delete('admin/categories/delete/{id}', 'StaffAdminController@destroyCategories')->name('adminstaff.deletecategories');

//Display available categories
Route::get('admin/products', 'StaffAdminController@showProducts')->name('adminstaff.products');
