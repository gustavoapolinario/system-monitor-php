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
Route::get('/report/{id}', 'ReportController@index')->where('id', '[0-9]+');
Route::get('/report/{id}/ajax', 'ReportController@ajax')->where('id', '[0-9]+');
Route::post('/report/{id}/ajax', 'ReportController@ajax')->where('id', '[0-9]+');

// http://stackoverflow.com/questions/28599638/using-ajax-and-returning-json-array-in-laravel-5
// Route::post('form-data',array('as'=>'form-data','uses'=>'FormController@formdata'));

/*
https://laravel.com/docs/5.4/authentication
Route::get('profile', function () {
    // Only authenticated users may enter...
})->middleware('auth');*/
