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

Route::get('token', function(){
    return csrf_token();
});

Route::resource('order', 'OrderController');

Route::resource('deferred', 'DeferredController');

Route::controller('basket', 'BasketController');

Route::get('cat-{category_id}', function ($category_id) {

    $products = \App\Models\Product::where('category_id', '=', $category_id);

    return view('home', ['products' => $products]);
});

Route::get('prod-{product_id}', function ($product_id) {

    $product_model = \App\Models\Product::findOrFail($product_id);

    $data = $product_model->toArray();

    $data['product'] = $product_model;

    $data['images'] = $product_model->images;

    return view('prod', $data);
});

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::group(['prefix' => 'media'], function() {

    Route::post('upload', 'MediaController@postUpload');
    Route::get('images/{width_height}/{file_name}', 'MediaController@getImage');
    Route::get('remove/{id}', 'MediaController@getRemove');

});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){

    Route::resource('/', '\App\Http\Controllers\Admin\IndexController');
    Route::resource('user', '\App\Http\Controllers\Admin\UserController');
    Route::resource('role', '\App\Http\Controllers\Admin\RoleController');
    Route::resource('permission', '\App\Http\Controllers\Admin\PermissionController');

    Route::resource('catalog', '\App\Http\Controllers\Admin\CatalogController');

    Route::resource('{catalog_id}/template-purchase', '\App\Http\Controllers\Admin\TemplatePurchaseController');

    Route::resource('{catalog_id}/pricing-column', '\App\Http\Controllers\Admin\PricingColumnController');

    Route::resource('{catalog_id}/product', '\App\Http\Controllers\Admin\ProductController');

});
