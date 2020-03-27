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

Route::post('register', 'UserController@register');
Route::post('login', 'UserController@login');

Route::get('iklan', 'IklanController@index');
Route::get('iklan/{id}', 'IklanController@show');
Route::post('iklan', 'IklanController@store');
Route::post('iklan/{id}', 'IklanController@update');
Route::delete('iklan/{id}', 'IklanController@destroy');
