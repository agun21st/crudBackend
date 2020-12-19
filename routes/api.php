<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

//? Token check with username password with /api/login
Route::post('/login', 'Api\AuthController@login');
Route::post('/register', 'Api\RegisterController@register');
//? email duplication checking before register
Route::post('/emailCheck', 'Api\RegisterController@emailCheck');

//? Access these API route with Auth Token
Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/logout', 'Api\AuthController@logout');
    Route::post('/createProduct', 'Api\ProductsController@create');
    Route::get('/getAllProducts', 'Api\ProductsController@getAllProducts');
    Route::patch('/updateProduct', 'Api\ProductsController@updateProduct');
    Route::post('/deleteProduct', 'Api\ProductsController@deleteProduct');
});

