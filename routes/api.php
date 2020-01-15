<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login', 'Auth\LoginController@login');
Route::post('/register', 'Auth\RegisterController@register');
Route::get('/user/{token}', 'Auth\LoginController@index');

Route::get('/product', 'ProductController@index');
Route::get('/product/{id}', 'ProductController@show');
Route::get('/product/latest', 'ProductController@latest');

Route::post('/cart', 'CartController@store');
Route::get('/cart/{token}', 'CartController@index');
Route::post('/cart/minAmount', 'CartController@minus');
Route::post('/cart/plusAmount', 'CartController@plus');
Route::get('/cart/price/{token}', 'CartController@total');
Route::delete('/cart/{id}', 'CartController@destroy');

Route::get('/checkout/{token}', 'CheckoutController@index');
Route::post('/order', 'CheckoutController@store');

Route::post('/product', 'ProductController@store');
Route::put('/product/{id}', 'ProductController@update');
Route::delete('/product/{id}', 'ProductController@destroy');