<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('home');
});
Route::get('prod', function () {
    return view('prod');
});

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){

    Route::resource('/', '\App\Http\Controllers\Admin\IndexController');
    Route::resource('user', '\App\Http\Controllers\Admin\UserController');
    Route::resource('role', '\App\Http\Controllers\Admin\RoleController');
    Route::resource('permission', '\App\Http\Controllers\Admin\PermissionController');

    Route::resource('catalog', '\App\Http\Controllers\Admin\CatalogController');
    Route::resource('template-purchase', '\App\Http\Controllers\Admin\TemplatePurchaseController');
    Route::resource('pricing-column', '\App\Http\Controllers\Admin\PricingColumnController');
    Route::resource('product', '\App\Http\Controllers\Admin\ProductController');

});
