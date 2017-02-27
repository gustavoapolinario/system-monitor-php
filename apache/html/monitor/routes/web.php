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

Route::get('/home', 'HomeController@index');
Route::get('/report/{id}', function ($id) {
    return $id;
})->where('id', '[0-9]+');

/*
https://laravel.com/docs/5.4/authentication
Route::get('profile', function () {
    // Only authenticated users may enter...
})->middleware('auth');*/
