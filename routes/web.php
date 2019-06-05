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

Route::get('/', 'HomeController@index');

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/about', 'HomeController@about')->name('about');
Route::get('/lang/{locale}', 'LocalizationController@locale')->name('locale');

Route::resource('artists', 'ArtistController')->except(['create', 'show', 'edit']);
Route::get('artists/import', 'ArtistController@import')->name('artists.import');
Route::get('api/artists', 'ArtistController@autocomplete')->name('api.artists.autocomplete');
Route::resource('departments', 'DepartmentController')->except(['create', 'show']);
Route::resource('discs', 'DiscController')->except(['create']);
Route::resource('albums', 'AlbumController')->except(['create', 'show']);
Route::get('albums/import', 'AlbumController@import')->name('albums.import');
Route::resource('parcels', 'ParcelController')->except(['create', 'show']);
Route::resource('deliveries', 'DeliveryController')->except(['create', 'show']);
Route::get('transactions/report', 'TransactionController@report')->name('report');
Route::resource('transactions', 'TransactionController')->except(['create', 'show']);
Route::resource('users', 'UserController')->except(['create']);

Route::get('search/albums', 'AlbumController@search')->name('albums.search');
