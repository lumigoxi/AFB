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

Auth::routes(['register'=>false]);

Route::get('dashboard', 'HomeController@index')->name('dashboard');
Route::resource('miembros', 'memberController')->except(['create', 'edit', 'show']);
Route::get('miembros/getAllUser', 'memberController@getAll');
Route::delete('miembros/eliminar-miembro/{id}', 'memberController@deleteMember')->name('deleteMember');
Route::group(['prefix'=> '/'], function(){
	Route::get('/historias', 'frontController@storyView');
	Route::get('adoptar', 'frontController@adoptView');
	Route::get('actividades', 'frontController@activityView');
});
Route::resource('/dashboard/historias', 'StoryController')->except(['create', 'edit', 'show']);


Route::get('actividades/getAllActivitys', 'ActivityController@getAll');
Route::resource('/dashboard/actividades', 'ActivityController')->except(['create', 'edit', 'show']);
