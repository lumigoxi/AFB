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
})->name('/');

Auth::routes();

Route::get('home', 'HomeController@index')->name('home');
Route::resource('miembros', 'memberController');
Route::group(['prefix'=> '/'], function(){
	Route::get('historias', 'frontController@storyView');
	Route::get('adoptar', 'frontController@adoptView');
	Route::get('actividades', 'frontController@activityView');
});
Route::resource('historias', 'storyController');
Route::resource('rescates', 'resqueController');
Route::resource('tratamientos', 'treatmentController');

