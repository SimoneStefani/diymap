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
Route::get('/map', 'HomeController@map');

Route::resource('/boards', 'BoardController');
Route::post('/boards/{board}/add-user', 'BoardController@addUser');
Route::get('/boards/{board}/users', 'BoardController@updateBoard');

Route::resource('/boards/{board}/places', 'PlaceController');

Route::resource('/locations', 'LocationController');

Route::get('/users/{userId}/location', 'UserLocationController@getUserLocation');
Route::post('/users/{userId}/update-location', 'UserLocationController@updateUserLocation');
