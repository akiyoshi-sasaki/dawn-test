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

Route::post('/charge', 'ChargeController@charge');

Route::post('/subscribe_process', 'HomeController@subscribe_process');

Route::post('/subscribe_cancel', 'HomeController@subscribe_cancel');

Route::get('/connect','HomeController@connect');
