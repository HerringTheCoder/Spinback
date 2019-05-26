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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/lang/{locale}', 'LocalizationController@locale')->name('locale');

Route::resource('artists', 'ArtistController')->except(['create', 'show']);
Route::resource('departments', 'DepartmentController')->except(['create', 'show']);
Route::resource('discs', 'DiscController')->except(['create', 'show']);
Route::resource('metadata', 'MetadataController')->except(['create', 'show']);
Route::resource('parcels', 'ParcelController')->except(['create', 'show']);
Route::resource('shipping_requests', 'ShippingRequestController')->except(['create', 'show']);
Route::resource('users', 'UserController')->except(['create', 'show']);

