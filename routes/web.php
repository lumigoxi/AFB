<?php

//route for landing page
Route::get('/', function () {
    return view('welcome');
})->name('/');

//register route disabled because can't a person register own  
Auth::routes(['register'=>false]);

//Rputes for dashboard
Route::resource('miembros', 'memberController')->except(['create', 'edit', 'show']);
Route::get('miembros/getAllUser', 'memberController@getAll');
Route::delete('miembros/eliminar-miembro/{id}', 'memberController@deleteMember')->name('deleteMember');
//Routes for web site. 
Route::group(['prefix'=> '/'], function(){
	Route::get('/historias', 'frontController@storyView');
	Route::get('adoptar', 'frontController@adoptView');
	Route::get('actividades', 'frontController@activityView');
});


Route::get('dashboard', 'HomeController@index')->name('dashboard');


//Route type resource for CRUD 
Route::resource('/dashboard/historias', 'StoryController')->except(['create', 'edit', 'show']);
Route::get('actividades/getAllActivitys', 'ActivityController@getAll');
Route::resource('/dashboard/actividades', 'ActivityController')->except(['create', 'edit']);
Route::get('rescue/getAllRescues', 'RescueController@getAll');
Route::resource('/dashboard/rescates', 'RescueController')->except(['create', 'edit']);
Route::resource('dashboard/', 'Controller')->except(['create']);


Route::resource('dashboard/Patrocinadores', 'SponsorController')->except(['create']);
Route::resource('dashboard/Pagos-Patrocinador', 'SponsorActivityController')->except(['create']);
Route::resource('dashboard/Cobros', 'InputPayController')->except(['create']);
Route::resource('dashboard/Caja', 'CashController')->except(['create']);
Route::resource('dashboard/Donaciones', 'DonationController')->except(['create']);
Route::resource('dashboard/Peticion-Adopcion', 'RequestRescueController')->except(['create']);
Route::resource('dashboard/Pagos', 'OutputPayController')->except(['create']);
Route::resource('dashboard/Mascotas', 'PetController')->except(['create']);
Route::resource('dashboard/Solicitud-Adopcion', 'RequestRescueController')->except(['create']);
Route::resource('dashboard/Amigos', 'PersonController')->except(['create']);
Route::resource('dashboard/Hospedaje', 'LodgingController')->except(['create']);
Route::resource('dashboard/Voluntarios', 'VoluntaryController')->except(['create']);
Route::resource('dashboard/Tratamientos', 'TreatmentController')->except(['create']);
Route::resource('dashboard/Veterinarios', 'vetController')->except(['create']);

