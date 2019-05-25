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

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/lang/{locale}', 'LocalizationController@locale')->name('locale');

//TODO: Partial resources for appropriate middleware role groups
Route::resources([
    'artists' => 'ArtistController',
    'departments' => 'DepartmentController',
    'discs' => 'DiscController',
    'metadata' => 'MetadataController',
    'parcels' => 'ParcelController',
    'permission_levels' => 'PermissionLevelController',
    'roles' => 'RoleController',
    'shipping_requests' => 'ShippingRequestController',
    'users' => 'UserController'
]);
