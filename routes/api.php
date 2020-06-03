<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

/* Products */
Route::get('products', 'ProductController@index');
Route::get('products/{id}', 'ProductController@show');
Route::post('products', 'ProductController@store');
Route::put('products/{id}', 'ProductController@update');
Route::delete('products/{id}', 'ProductController@delete');

/* Clients */
Route::get('clients', 'ClientController@index');
Route::get('clients/{id}', 'ClientController@show');
Route::post('clients', 'ClientController@store');
Route::put('clients/{id}', 'ClientController@update');
Route::delete('clients/{id}', 'ClientController@delete');

/* Sales */
Route::get('sales', 'SaleController@index');
Route::get('sales/{id}', 'SaleController@show');
Route::post('sales', 'SaleController@store');