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

Route::get('/','MainController@index')->name('index');

Route::post('/','MainController@post')->name('post');

Route::post('/admin','MainController@admin')->name('admin');

Route::resource('/board','BoardController');
Route::resource('/return','ReturnController');
