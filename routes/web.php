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

Route::get('/test', function () {
    var_dump(\Auth::check());
    return "check=".\Auth::check();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('login/twitter', 'Auth\TwitterController@redirectToProvider');
Route::get('login/twitter/cl', 'Auth\TwitterController@handleProviderCallback');
